<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Settings extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'phone_number',
        'location',
        'address',
        'zip_code',
        'city',
        'facebook',
        'instagram',
        'google_tag_manager',
    ];

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('icon')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('front-mobile-header')
                    ->fit(Manipulations::FIT_CROP, 70, 70)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages();
                $this->addMediaConversion('admin-header')
                    ->fit(Manipulations::FIT_CROP, 30, 30)
                    ->keepOriginalImageFormat();
                $this->addMediaConversion('mail')
                    ->fit(Manipulations::FIT_CROP, 50, 50)
                    ->keepOriginalImageFormat();
                $this->addMediaConversion('auth')
                    ->fit(Manipulations::FIT_CROP, 225, 225)
                    ->keepOriginalImageFormat()
                    ->withResponsiveImages();
            });
    }

    /**
     * Register the media conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
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
