<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class BricksController extends \Okipa\LaravelBrickables\Controllers\BricksController
{
    protected function sendBrickCreatedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('crud.parent.created', [
            'parent' => $brick->model->getReadableClassName(),
            'entity' => __('Content bricks'),
            'name' => $brick->brickable->getLabel(),
        ]));
    }

    protected function sendBrickUpdatedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('crud.parent.updated', [
            'parent' => $brick->model->getReadableClassName(),
            'entity' => __('Content bricks'),
            'name' => $brick->brickable->getLabel(),
        ]));
    }

    protected function sendBrickDestroyedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('crud.parent.destroyed', [
            'parent' => $brick->model->getReadableClassName(),
            'entity' => __('Content bricks'),
            'name' => $brick->brickable->getLabel(),
        ]));
    }
}
