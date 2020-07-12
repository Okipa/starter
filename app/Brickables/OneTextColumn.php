<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\OneTextColumn\OneTextColumnStoreRequest;
use App\Http\Requests\Brickables\OneTextColumn\OneTextColumnUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumn extends Brickable
{
    public function validateStoreInputs(): array
    {
        return (new OneTextColumnStoreRequest)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return (new OneTextColumnUpdateRequest)->validated();
    }
}
