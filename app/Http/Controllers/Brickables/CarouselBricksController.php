<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CarouselBricksController extends BricksController
{
    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $slide
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroySlide(Media $slide): RedirectResponse
    {
        $brick = $slide->model;
        /** @var \Okipa\LaravelBrickables\Contracts\HasBrickables $model */
        $model = $brick->model;
        /** @var \Okipa\LaravelBrickables\Abstracts\Brickable $brickable */
        $brickable = $brick->brickable;
        $name = translatedData($slide->getCustomProperty('label'));
        $slide->delete();

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => $model->getReadableClassName(),
            'entity' => $brickable->getLabel(),
            'name' => $name,
        ]));
    }

    public function moveUpSlide(Media $slide): RedirectResponse
    {
        /** @var \Illuminate\Support\Collection $slides */
        $slides = $slide->model->getMedia('slides');
        $prev = $slides->where('order_column', '<', $slide->order_column)->values();
        $next = $slides->where('order_column', '>', $slide->order_column)->values();
        $itemToSwitchIndex = $next->count() ? $next->count() - 1 : $next->count();
        if ($next->has($itemToSwitchIndex)) {
            $prev->push($next->pull($itemToSwitchIndex));
        }
        $next->prepend($slide);
        $ids = [...$prev->pluck('id'), ...$next->pluck('id')];
        Media::setNewOrder($ids);

        return back()->with('toast_success', __('Slide moved up.'));
    }

    public function moveDownSlide(Media $slide): RedirectResponse
    {
        /** @var \Illuminate\Support\Collection $slides */
        $slides = $slide->model->getMedia('slides');
        $prev = $slides->where('order_column', '<', $slide->order_column)->values();
        $next = $slides->where('order_column', '>', $slide->order_column)->values();
        $itemToSwitchIndex = $prev->count() - 1;
        if ($prev->has($itemToSwitchIndex)) {
            $next->push($prev->pull($itemToSwitchIndex));
        }
        $prev->push($slide);
        $ids = [...$prev->pluck('id'), ...$next->pluck('id')];
        Media::setNewOrder($ids);

        return back()->with('toast_success', __('Slide moved down.'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function stored(Request $request, Brick $brick): void
    {
        $this->addNewSlide($request, $brick);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     *
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function addNewSlide(Request $request, Brick $brick): Media
    {
        $image = $request->file('image');

        /** @var \Spatie\MediaLibrary\HasMedia $brick */
        return $brick->addMedia($image->getRealPath())
            ->setFileName($image->getClientOriginalName())
            ->withCustomProperties(['label' => $request->label, 'caption' => $request->caption])
            ->toMediaCollection('slides');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function updated(Request $request, Brick $brick): void
    {
        if ($request->file('image')) {
            /** @var \App\Models\Brickables\CarouselFullWidthBrick $brick */
            $this->addNewSlide($request, $brick);
        }
    }
}
