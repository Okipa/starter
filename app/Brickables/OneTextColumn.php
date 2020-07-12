<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\OneTextColumn\OneTextColumnStoreRequest;
use App\Http\Requests\Brickables\OneTextColumn\OneTextColumnUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumn extends Brickable
{
    public function validateStoreInputs(): array
    {
        return app(OneTextColumnStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(OneTextColumnUpdateRequest::class)->validated();
    }
}
