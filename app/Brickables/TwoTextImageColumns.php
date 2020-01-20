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
        $rules = [
            'right_image' => array_merge(['required'], $this->getBrickModel()->validationConstraints('bricks')),
            'invert_order' => ['nullable', 'in:on'],
        ];
        $localizedRules = (new Request)->localizeRules(['left_text' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }

    /** @inheritDoc */
    protected function setUpdateValidationRules(): array
    {
        $rules = [
            'right_image' => $this->getBrickModel()->validationConstraints('bricks'),
            'invert_order' => ['in:0,1'],
        ];
        $localizedRules = (new Request)->localizeRules(['left_text' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }
}
