<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\CarouselBricksController;
use App\Http\Requests\Brickables\Carousel\CarouselStoreRequest;
use App\Http\Requests\Brickables\Carousel\CarouselUpdateRequest;
use App\Models\Brickables\CarouselBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Carousel extends Brickable
{
    public function validateStoreInputs(): array
    {
        return (new CarouselStoreRequest)->validated();
    }

    public function validateUpdateInputs(): array
    {
        return (new CarouselUpdateRequest)->validated();
    }

    protected function setBrickModelClass(): string
    {
        return CarouselBrick::class;
    }

    protected function setBricksControllerClass(): string
    {
        return CarouselBricksController::class;
    }

    protected function setJsResourcePath(): ?string
    {
        return mix('/js/brickables/carousel.js');
    }
}
