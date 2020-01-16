<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextImageColumns extends Brickable
{
    /** @inheritDoc */
    protected function setValidationRules(): array
    {
        $rules = ['right_image' => $this->getBrickModel()->validationConstraints('images')];
        $localizedRules = (new Request)->localizeRules(['left_text' => ['required', 'string']]);

        return array_merge($rules, $localizedRules);
    }
}
