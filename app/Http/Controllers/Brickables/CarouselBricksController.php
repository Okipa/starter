<?php

namespace App\Http\Controllers\Brickables;

use App\Tables\CarouselBrickSlidesTables;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Okipa\LaravelBrickables\Models\Brick;

class CarouselBricksController extends BricksController
{
    /**
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \ErrorException
     * @throws \Exception
     */
    public function edit(Brick $brick, Request $request): View
    {
        $view = parent::edit($brick, $request);
        $table = (new CarouselBrickSlidesTables($brick, $request->admin_panel_url))->setup();
        $view->with(compact('table'));

        return $view;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     *
     * @return \Illuminate\Http\RedirectResponse
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function sendBrickCreatedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->route('brick.edit', [
            'brick' => $brick,
            'admin_panel_url' => $request->admin_panel_url,
        ])->with('success', __('The entry :model > :brickable has been created.', [
            'brickable' => $brick->brickable->getLabel(),
            'model' => $brick->model->getReadableClassName(),
        ]));
    }
}
