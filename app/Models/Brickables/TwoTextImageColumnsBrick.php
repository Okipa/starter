<?php

namespace App\Models\Brickables;

use Okipa\LaravelBrickables\Models\Brick;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class TwoTextImageColumnsBrick extends Brick implements HasMedia
{
    use HasMediaTrait;

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('bricks')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('image')
                    ->fit(Manipulations::FIT_CROP, 540, 400)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat();
            });
    }

    /**
     * Register the media conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }
}
