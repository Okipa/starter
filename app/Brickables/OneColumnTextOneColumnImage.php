<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\TwoTextImageBricksController;
use App\Http\Requests\Brickables\OneColumnTextOneColumnImage\OneColumnTextOneColumnImageStoreRequest;
use App\Http\Requests\Brickables\OneColumnTextOneColumnImage\OneColumnTextOneColumnImageUpdateRequest;
use App\Models\Brickables\OneColumnTextOneColumnImageBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneColumnTextOneColumnImage extends Brickable
{
    protected function setBrickModelClass(): string
    {
        return OneColumnTextOneColumnImageBrick::class;
    }

    protected function setBricksControllerClass(): string
    {
        return TwoTextImageBricksController::class;
    }

    public function validateStoreInputs(): array
    {
        return app(OneColumnTextOneColumnImageStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(OneColumnTextOneColumnImageUpdateRequest::class)->validated();
    }
}
