<?php

namespace App\Components\Media;

class Image extends \Okipa\LaravelBootstrapComponents\Components\Media\Image
{
    protected function setLinkHtmlAttributes(): array
    {
        return ['data-lightbox'];
    }
}
