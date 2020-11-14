<?php

namespace App\Http\Controllers\Brickables;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brickables\Carousel\CarouselSlidesReorganizeRequest;
use App\Http\Requests\Brickables\Carousel\CarouselSlideStoreRequest;
use App\Http\Requests\Brickables\Carousel\CarouselSlideUpdateRequest;
use App\Models\Brickables\CarouselBrick;
use App\Models\Brickables\CarouselBrickSlide;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class CarouselBrickSlidesController extends Controller
{
    public function create(CarouselBrick $brick): View
    {
        $slide = null;
        SEOTools::setTitle(__('breadcrumbs.parent.create', [
            'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
            'entity' => __('Slides'),
        ]));

        return view('vendor.laravel-brickables.brickables.carousel.slides.edit', compact('brick', 'slide'));
    }

    /**
     * @param \App\Http\Requests\Brickables\Carousel\CarouselSlideStoreRequest $request
     * @param \App\Models\Brickables\CarouselBrick $brick
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function store(CarouselSlideStoreRequest $request, CarouselBrick $brick): RedirectResponse
    {
        $slide = CarouselBrickSlide::create(array_merge(
            $request->validated(),
            ['brick_id' => $brick->id]
        ));
        $slide->addMediaFromRequest('image')->toMediaCollection('images');

        return redirect()->route('brick.edit', [
            'brick' => $brick,
            'admin_panel_url' => $request->admin_panel_url,
        ])->with('toast_success', __('notifications.parent.created', [
            'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
            'entity' => __('Slides'),
            'name' => $slide->label,
        ]));
    }

    public function edit(CarouselBrickSlide $slide): View
    {
        $brick = $slide->brick;
        SEOTools::setTitle(__('breadcrumbs.parent.edit', [
            'parent' => $brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > ' . __('Carousel'),
            'entity' => __('Slides'),
            'detail' => $slide->label,
        ]));

        return view('vendor.laravel-brickables.brickables.carousel.slides.edit', compact('brick', 'slide'));
    }

    public function update(CarouselSlideUpdateRequest $request, CarouselBrickSlide $slide): RedirectResponse
    {
        $slide->update($request->validated());
        if ($request->file('images')) {
            $slide->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return back()->with('toast_success', __('notifications.parent.updated', [
            'parent' => $slide->brick->model->getReadableClassName() . ' > ' . __('Content bricks') . ' > '
                . __('Carousel'),
            'entity' => __('Slides'),
            'name' => $slide->label,
        ]));
    }

    public function destroy(CarouselBrickSlide $slide): RedirectResponse
    {
        $slide->delete();
        $orderedIds = CarouselBrickSlide::where('brick_id', $slide->brick->id)
            ->ordered()
            ->pluck('id');
        CarouselBrickSlide::setNewOrder($orderedIds);

        return back()->with('toast_success', __('notifications.parent.destroyed', [
            'parent' => $slide->brick->model->getReadableClassName() . ' > ' . __('Carousel'),
            'entity' => __('Slides'),
            'name' => $slide->label,
        ]));
    }

    public function reorganize(CarouselSlidesReorganizeRequest $request): JsonResponse
    {
        CarouselBrickSlide::setNewOrder($request->validated()['ordered_ids']);

        return response()->json(['message' => 'La liste a été réorganisée.'], 200);
    }
}
