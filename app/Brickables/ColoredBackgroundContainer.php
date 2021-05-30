<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\ColoredBackgroundContainer\ColoredBackgroundContainerStoreRequest;
use App\Http\Requests\Brickables\ColoredBackgroundContainer\ColoredBackgroundContainerUpdateRequest;
use App\Models\Brickables\ColoredBackgroundContainerBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class ColoredBackgroundContainer extends Brickable
{
    public const BACKGROUND_COLORS = [
        'transparent' => ['key' => 'transparent', 'label' => 'Transparent', 'classes' => 'bg-transparent'],
        'gray_light' => ['key' => 'gray_light', 'label' => 'Gray light', 'classes' => 'bg-light'],
        'gray_dark' => ['key' => 'gray_dark', 'label' => 'Gray dark', 'classes' => 'bg-dark'],
        'green' => ['key' => 'green', 'label' => 'Green', 'classes' => 'bg-success'],
        'blue' => ['key' => 'blue', 'label' => 'Blue', 'classes' => 'bg-info'],
        'orange' => ['key' => 'orange', 'label' => 'Orange', 'classes' => 'bg-warning'],
        'red' => ['key' => 'red', 'label' => 'Red', 'classes' => 'bg-danger'],
    ];

    public const ALIGNMENTS = [
        'left' => ['key' => 'left', 'label' => 'Left', 'classes' => 'justify-content-start'],
        'center' => ['key' => 'center', 'label' => 'Center', 'classes' => 'justify-content-center'],
        'right' => ['key' => 'right', 'label' => 'Right', 'classes' => 'justify-content-right'],
        'between' => ['key' => 'between', 'label' => 'Spread', 'classes' => 'justify-content-between'],
    ];

    public function validateStoreInputs(): array
    {
        return app(ColoredBackgroundContainerStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(ColoredBackgroundContainerUpdateRequest::class)->validated();
    }

    protected function setBrickModelClass(): string
    {
        return ColoredBackgroundContainerBrick::class;
    }
}
