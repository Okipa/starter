<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\TitleH1\TitleH1StoreRequest;
use App\Http\Requests\Brickables\TitleH1\TitleH1UpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TitleH1 extends Brickable
{
    public function validateStoreInputs(): array
    {
        return app(TitleH1StoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(TitleH1UpdateRequest::class)->validated();
    }
}
