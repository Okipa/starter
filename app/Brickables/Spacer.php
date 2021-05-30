<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\Spacer\SpacerStoreRequest;
use App\Http\Requests\Brickables\Spacer\SpacerUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Spacer extends Brickable
{
    public function validateStoreInputs(): array
    {
        return app(SpacerStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(SpacerUpdateRequest::class)->validated();
    }
}
