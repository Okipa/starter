<?php

namespace App\Brickables;

use Okipa\LaravelBrickables\Abstracts\Brickable;

class OneTextColumn extends Brickable
{
    protected function setStoreValidationRules(): array
    {
        return localizeRules(['text' => ['required', 'string']]);
    }

    protected function setUpdateValidationRules(): array
    {
        return localizeRules(['text' => ['required', 'string']]);
    }
}
