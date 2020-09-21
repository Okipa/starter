<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Settings extends Model implements HasMedia
{
    use InteractsWithMedia, ExtendsMediaAbilities;

    /** @var string $table */
    protected $table = 'settings';

    /** @var array $fillable */
    protected $fillable = [
        'email',
        'phone_number',
        'location',
        'address',
        'zip_code',
        'city',
        'facebook',
        'instagram',
        'google_tag_manager_id',
    ];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icons')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('front')
                    ->fit(Manipulations::FIT_CROP, 70, 70)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages()
                    ->nonQueued();
                $this->addMediaConversion('admin')
                    ->fit(Manipulations::FIT_CROP, 30, 30)
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('mail')
                    ->fit(Manipulations::FIT_CROP, 50, 50)
                    ->keepOriginalImageFormat()
                    ->nonQueued();
                $this->addMediaConversion('auth')
                    ->fit(Manipulations::FIT_CROP, 225, 225)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages()
                    ->nonQueued();
            });
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
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    public function getFullPostalAddressAttribute(): string
    {
        $fullPostalAddress = '';
        $fullPostalAddress .= $this->address ?: '';
        $fullPostalAddress .= $this->zip_code ? ($fullPostalAddress ? ' ' : '') . $this->zip_code : '';
        $fullPostalAddress .= $this->city ? ($fullPostalAddress ? ' ' : '') . $this->city : '';

        return $fullPostalAddress;
    }
}
