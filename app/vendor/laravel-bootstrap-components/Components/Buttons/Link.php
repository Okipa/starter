<?php

namespace App\Vendor\LaravelBootstrapComponents\Components\Buttons;

class Link extends \Okipa\LaravelBootstrapComponents\Components\Buttons\Link
{
    /**
     * @inheritDoc
     */
    protected function setComponentClasses(): array
    {
        return ['btn-primary', 'btn-link', 'load-on-click'];
    }
}
