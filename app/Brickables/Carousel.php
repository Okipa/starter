<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\CarouselBricksController;
use App\Models\Brickables\CarouselBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class Carousel extends Brickable
{
    protected function setBrickModelClass(): string
    {
        return CarouselBrick::class;
    }

    protected function setBricksControllerClass(): string
    {
        return CarouselBricksController::class;
    }

    protected function setStoreValidationRules(): array
    {
        /** @var \App\Models\Brickables\CarouselBrick $model */
        $model = $this->getBrickModel();
        $rules = [
            'full_width' => ['nullable', 'in:on'],
            'image' => array_merge(['required'], $model->getMediaValidationRules('slides')),
        ];
        $localizedRules = localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }

    protected function setUpdateValidationRules(): array
    {
        /** @var \App\Models\Brickables\CarouselBrick $model */
        $model = $this->getBrickModel();
        $rules = [
            'full_width' => ['nullable', 'in:on'],
            'image' => $model->getMediaValidationRules('slides'),
        ];
        $localizedRules = localizeRules([
            'label' => ['nullable', 'string', 'max:75'],
            'caption' => ['nullable', 'string', 'max:150'],
        ]);

        return array_merge($rules, $localizedRules);
    }
}
