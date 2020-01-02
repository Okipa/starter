<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Button extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Button
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'load-on-click'];
    }
}
