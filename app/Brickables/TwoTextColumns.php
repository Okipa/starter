<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextColumns extends Brickable
{
    /** @inheritDoc */
    protected function setValidationRules(): array
    {
        return (new Request)->localizeRules([
            'left_text' => ['required', 'string'],
            'right_text' => ['required', 'string'],
        ]);
    }
}
