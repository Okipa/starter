<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Back extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Back
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-secondary', 'load-on-click'];
    }
}
