<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\Title\TitleStoreRequest;
use App\Http\Requests\Brickables\Title\TitleUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Title extends Brickable
{
    public const TYPES = [
        'h1' => ['key' => 'h1', 'label' => 'H1', 'html_tag' => 'h1'],
        'h2' => ['key' => 'h2', 'label' => 'H2', 'html_tag' => 'h2'],
        'h3' => ['key' => 'h3', 'label' => 'H3', 'html_tag' => 'h3'],
        'h4' => ['key' => 'h4', 'label' => 'H4', 'html_tag' => 'h4'],
        'h5' => ['key' => 'h5', 'label' => 'H5', 'html_tag' => 'h5'],
        'h6' => ['key' => 'h6', 'label' => 'H6', 'html_tag' => 'h6'],
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
