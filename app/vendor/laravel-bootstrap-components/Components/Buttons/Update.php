<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Update extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Update
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'load-on-click'];
    }
}
