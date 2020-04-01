<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class BricksController extends \Okipa\LaravelBrickables\Controllers\BricksController
{
    protected function sendBrickCreatedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('notifications.orphan.created', [
            'entity' => $brick->model->getReadableClassName(),
            'name' => $brick->brickable->getLabel(),
        ]));
    }

    protected function sendBrickUpdatedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('notifications.orphan.updated', [
            'entity' => $brick->model->getReadableClassName(),
            'name' => $brick->brickable->getLabel(),
        ]));
    }

    protected function sendBrickDestroyedResponse(Request $request, Brick $brick): RedirectResponse
    {
        return redirect()->to($request->admin_panel_url)->with('toast_success', __('notifications.orphan.destroyed', [
            'entity' => $brick->model->getReadableClassName(),
            'name' => $brick->brickable->getLabel(),
        ]));
    }
}
