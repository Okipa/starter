<?php

namespace App\Brickables;

use App\Http\Controllers\Brickables\TwoTextImageBricksController;
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

    protected function setStoreValidationRules(): array
    {
        /** @var \Okipa\MediaLibraryExt\ExtendsMediaAbilities $model */
        $model = $this->getBrickModel();
        $rules = [
            'right_image' => array_merge(['required'], $model->getMediaValidationRules('images')),
            'invert_order' => ['nullable', 'in:on'],
        ];
        $localizedRules = localizeRules(['text_left' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }

    protected function setUpdateValidationRules(): array
    {
        /** @var \Okipa\MediaLibraryExt\ExtendsMediaAbilities $model */
        $model = $this->getBrickModel();
        $rules = [
            'right_image' => $model->getMediaValidationRules('images'),
            'invert_order' => ['nullable', 'in:on'],
        ];
        $localizedRules = localizeRules(['text_left' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }
}
