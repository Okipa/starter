<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Submit extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Submit
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'load-on-click'];
    }
}
