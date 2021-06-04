<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\ThreeTextColumns\ThreeTextColumnsStoreRequest;
use App\Http\Requests\Brickables\ThreeTextColumns\ThreeTextColumnsUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class ThreeTextColumns extends Brickable
{
    public function validateStoreInputs(): array
    {
        return app(ThreeTextColumnsStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(ThreeTextColumnsUpdateRequest::class)->validated();
    }
}
