<?php

namespace App\Http\Controllers\Brickables;

use Illuminate\Http\Request;
use Okipa\LaravelBrickables\Models\Brick;

class TwoTextImageBricksController extends BricksController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Okipa\LaravelBrickables\Models\Brick $brick
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function stored(Request $request, Brick $brick): void
    {
        /** @var \App\Models\Brickables\TwoTextImageColumnsBrick $brick */
        $brick->addMediaFromRequest('right_image')->toMediaCollection('images');
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
        if ($request->file('right_image')) {
            /** @var \App\Models\Brickables\TwoTextImageColumnsBrick $brick */
            $brick->addMediaFromRequest('right_image')->toMediaCollection('images');
        }
    }
}
