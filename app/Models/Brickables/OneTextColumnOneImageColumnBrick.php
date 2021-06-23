<?php

namespace App\Models\Brickables;

use Okipa\LaravelBrickables\Models\Brick;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OneTextColumnOneImageColumnBrick extends Brick implements HasMedia
{
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /** @var array */
    protected $with = ['media'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->singleFile()
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->registerMediaConversions(fn(Media $media = null) => $this->addMediaConversion('half')
                ->fit(Manipulations::FIT_CROP, 540, 400)
                ->withResponsiveImages()
                ->format('webp'));
    }

    /**
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }
}
