<?php

namespace App\Models\Abstracts;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

abstract class Seo extends Metable implements HasMedia
{
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    protected array $seoTags = ['meta_title', 'meta_description'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('seo')
            ->singleFile()
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->registerMediaConversions(fn(Media $media = null) => $this->addMediaConversion('image')
                ->fit(Manipulations::FIT_CROP, 600, 600)
                ->format('webp'));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param \Spatie\MediaLibrary\MediaCollections\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->format('webp');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function saveSeoMetaFromRequest(Request $request): void
    {
        $this->saveMetaFromRequest($request, $this->seoTags);
        if ($request->has('remove_meta_image')) {
            $this->clearMediaCollection('seo');
        }
        if ($request->file('meta_image')) {
            $this->addMediaFromRequest('meta_image')->toMediaCollection('seo');
        }
    }

    public function saveSeoMeta(array $values): void
    {
        foreach ($this->seoTags as $tag) {
            if ($this->hasMeta($tag)) {
                $this->removeMeta($tag);
            }
            if (! empty(data_get($values, $tag))) {
                $this->setMeta($tag, data_get($values, $tag));
            }
        }
    }

    public function displaySeoMeta(): void
    {
        SEOTools::setTitle($this->getMeta('meta_title'));
        SEOTools::setDescription($this->getMeta('meta_description'));
        $metaImage = $this->getFirstMedia('seo');
        if ($metaImage) {
            $metaImageResource = Image::load($metaImage->getPath('image'));
            SeoTools::addImages([
                $metaImage->getFullUrl('image'), [
                    'width' => $metaImageResource->getWidth(),
                    'height' => $metaImageResource->getHeight(),
                ],
            ]);
        }
    }
}
