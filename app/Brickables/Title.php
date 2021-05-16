<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\Title\TitleStoreRequest;
use App\Http\Requests\Brickables\Title\TitleUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Title extends Brickable
{
    public const TYPES = [
        'h1' => ['key' => 'h1', 'label' => 'H1'],
        'h2' => ['key' => 'h2', 'label' => 'H2'],
        'h3' => ['key' => 'h3', 'label' => 'H3'],
        'h4' => ['key' => 'h4', 'label' => 'H4'],
        'h5' => ['key' => 'h5', 'label' => 'H5'],
        'h6' => ['key' => 'h6', 'label' => 'H6'],
    ];

    public const STYLES = [
        'h1' => ['key' => 'h1', 'label' => 'H1', 'classes' => 'h1'],
        'h2' => ['key' => 'h2', 'label' => 'H2', 'classes' => 'h2'],
        'h3' => ['key' => 'h3', 'label' => 'H3', 'classes' => 'h3'],
        'h4' => ['key' => 'h4', 'label' => 'H4', 'classes' => 'h4'],
        'h5' => ['key' => 'h5', 'label' => 'H5', 'classes' => 'h5'],
        'h6' => ['key' => 'h6', 'label' => 'H6', 'classes' => 'h6'],
    ];

    public function validateStoreInputs(): array
    {
        return app(TitleStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(TitleUpdateRequest::class)->validated();
    }
}
