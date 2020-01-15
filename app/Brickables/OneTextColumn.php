<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumn extends Brickable
{
    /**
     * @inheritDoc
     */
    public function setValidationRules(): array
    {
        return (new Request)->localizeRules(['content' => ['required', 'string']]);
    }
}
