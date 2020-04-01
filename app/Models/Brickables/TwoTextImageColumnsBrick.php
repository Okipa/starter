<?php

namespace App\Models\Brickables;

use Okipa\LaravelBrickables\Models\Brick;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TwoTextImageColumnsBrick extends Brick implements HasMedia
{
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(fn(Media $media = null) => $this->addMediaConversion('half')
                ->fit(Manipulations::FIT_CROP, 540, 400)
                ->withResponsiveImages()
                ->keepOriginalImageFormat()
                ->nonQueued());
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat()
            ->nonQueued();
    }
}
