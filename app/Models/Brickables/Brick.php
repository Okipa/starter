<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Brick extends \Okipa\LaravelBrickables\Models\Brick implements HasMedia
{
    use HasMediaTrait;

    /** @inheritDoc */
    public function toHtml(): string
    {
        return (string) view($this->brickable->getBrickViewPath(), array_merge($this->getTranslatedData(), ['brick' => $this]));
    }

    /**
     * @return array
     */
    protected function getTranslatedData(): array
    {
        if (multilingual()) {
            return array_map(function ($data) {
                return $data[app()->getLocale()];
            }, $this->data);
        }

        return $this->data;
    }

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('bricks')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('image')
                    ->fit(Manipulations::FIT_CROP, 2560, 800)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat();
            });
    }

    /**
     * Register the media conversions.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }
}
