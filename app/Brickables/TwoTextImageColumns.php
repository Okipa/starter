<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\TwoTextImageBricksController;
use App\Http\Requests\Request;
use App\Models\Brickables\TwoTextImageColumnsBrick;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextImageColumns extends Brickable
{
    /** @inheritDoc */
    protected function setBrickModelClass(): string
    {
        return TwoTextImageColumnsBrick::class;
    }

    /** @inheritDoc */
    protected function setBricksControllerClass(): string
    {
        return TwoTextImageBricksController::class;
    }

    /** @inheritDoc */
    protected function setStoreValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'right_image' => array_merge(['required'], $model->validationConstraints('bricks')),
            'invert_order' => ['nullable', 'in:on'],
        ];
        $localizedRules = (new Request)->localizeRules(['left_text' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        /** @var \Spatie\MediaLibrary\HasMedia\HasMedia $model */
        $model = $this->getBrickModel();
        $rules = [
            'right_image' => $model->validationConstraints('bricks'),
            'invert_order' => ['nullable', 'in:on'],
        ];
        $localizedRules = (new Request)->localizeRules(['left_text' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }
}
