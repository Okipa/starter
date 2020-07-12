<?php

namespace App\Brickables;

use App\Http\Requests\Brickables\TitleH1\TitleH1StoreRequest;
use App\Http\Requests\Brickables\TitleH1\TitleH1UpdateRequest;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TitleH1 extends Brickable
{
    public function validateStoreInputs(): array
    {
        return (new TitleH1StoreRequest)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return (new TitleH1UpdateRequest)->validated();
    }
}
