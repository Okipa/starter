<?php

namespace App\Brickables;

use Okipa\LaravelBrickables\Abstracts\Brickable;

class TitleH1 extends Brickable
{
    protected function setStoreValidationRules(): array
    {
        return localizeRules(['title' => ['required', 'string']]);
    }

    protected function setUpdateValidationRules(): array
    {
        return localizeRules(['title' => ['required', 'string']]);
    }
}
