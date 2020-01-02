<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Cancel extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Cancel
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-secondary', 'load-on-click'];
    }
}
