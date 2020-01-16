<?php

namespace App\Brickables\Two;

use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class BricksController extends \Okipa\LaravelBrickables\Controllers\BricksController
{
    /** @inheritDoc */
    protected function sendBrickCreatedResponse(Request $request, Brick $brick)
    {
        return redirect()->to($request->admin_panel_url)
            ->with('toast_success', __('The entry :model > :brickable has been created.', [
                'brickable' => $brick->brickable->getLabel(),
                'model' => $brick->model->getReadableClassName(),
            ]));
    }
}
