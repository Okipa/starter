<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Validate extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Validate
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'load-on-click'];
    }
}
