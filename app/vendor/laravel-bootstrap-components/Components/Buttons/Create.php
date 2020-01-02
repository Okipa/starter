<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Create extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Create
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'load-on-click'];
    }
}
