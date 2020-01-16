<?php

namespace App\Brickables;

use App\Http\Requests\Request;
use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumn extends Brickable
{
    /** @inheritDoc */
    protected function setValidationRules(): array
    {
        return (new Request)->localizeRules(['text' => ['required', 'string']]);
    }
}
