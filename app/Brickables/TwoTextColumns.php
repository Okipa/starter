<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\TwoTextColumns\TwoTextColumnsStoreRequest;
use App\Http\Requests\Brickables\TwoTextColumns\TwoTextColumnsUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextColumns extends Brickable
{
    public function validateStoreInputs(): array
    {
        return (new TwoTextColumnsStoreRequest)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return (new TwoTextColumnsUpdateRequest)->validated();
    }
}
