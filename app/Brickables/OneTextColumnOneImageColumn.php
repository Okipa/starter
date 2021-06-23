<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\OneTextColumnOneImageColumnBricksController;
use App\Http\Requests\Brickables\OneTextColumnOneImageColumn\OneTextColumnOneImageColumnStoreRequest;
use App\Http\Requests\Brickables\OneTextColumnOneImageColumn\OneTextColumnOneImageColumnUpdateRequest;
use App\Models\Brickables\OneTextColumnOneImageColumnBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumnOneImageColumn extends Brickable
{
    protected function setBrickModelClass(): string
    {
        return OneTextColumnOneImageColumnBrick::class;
    }

    protected function setBricksControllerClass(): string
    {
        return OneTextColumnOneImageColumnBricksController::class;
    }

    public function validateStoreInputs(): array
    {
        return app(OneTextColumnOneImageColumnStoreRequest::class)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return app(OneTextColumnOneImageColumnUpdateRequest::class)->validated();
    }
}
