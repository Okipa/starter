<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class TwoTextImageBricksController extends BricksController
{
    /** @inheritDoc */
    protected function stored(Request $request, Brick $brick): void
    {
        $brick->addMediaFromRequest('right_image')->toMediaCollection('bricks');
    }

    /** @inheritDoc */
    protected function updated(Request $request, Brick $brick): void
    {
        if ($request->file('image')) {
            $brick->addMediaFromRequest('right_image')->toMediaCollection('bricks');
        }
    }
}
