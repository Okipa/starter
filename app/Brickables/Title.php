<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\Title\TitleStoreRequest;
use App\Http\Requests\Brickables\Title\TitleUpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Title extends Brickable
{
    public function validateStoreInputs(): array
    {
        return app(TitleStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(TitleUpdateRequest::class)->validated();
    }
}
