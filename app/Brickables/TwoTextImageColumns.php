<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\TwoTextImageBricksController;
use App\Http\Requests\Brickables\TwoTextImageColumns\TwoTextImageColumnsStoreRequest;
use App\Http\Requests\Brickables\TwoTextImageColumns\TwoTextImageColumnsUpdateRequest;
use App\Models\Brickables\TwoTextImageColumnsBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextImageColumns extends Brickable
{
    protected function setBrickModelClass(): string
    {
        return TwoTextImageColumnsBrick::class;
    }

    protected function setBricksControllerClass(): string
    {
        return TwoTextImageBricksController::class;
    }

    public function validateStoreInputs(): array
    {
        return (new TwoTextImageColumnsStoreRequest)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return (new TwoTextImageColumnsUpdateRequest)->validated();
    }
}
