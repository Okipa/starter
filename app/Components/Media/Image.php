<?php

namespace App\Components\Media;

class Image extends \Okipa\LaravelBootstrapComponents\Components\Media\Image
{
    /** @inheritDoc */
    protected function setLinkHtmlAttributes(): array
    {
        return ['data-lity'];
    }
}
