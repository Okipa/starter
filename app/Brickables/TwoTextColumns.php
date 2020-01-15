<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class TwoTextColumns extends Brickable
{
    /**
     * @inheritDoc
     */
    public function setValidationRules(): array
    {
        return (new Request)->localizeRules([
            'left_content' => ['required', 'string'],
            'right_content' => ['required', 'string'],
        ]);
    }
}
