<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Settings extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    /** @var string*/
    protected $table = 'settings';

    /** @var array */
    protected $fillable = [
        'email',
        'phone_number',
        'address',
        'zip_code',
        'city',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'google_tag_manager_id',
    ];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo_square')
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('nav_front')
                    ->fit(Manipulations::FIT_CROP, 70, 70)
                    ->withResponsiveImages()
                    ->format('webp');
                $this->addMediaConversion('nav_admin')
                    ->fit(Manipulations::FIT_CROP, 30, 30)
                    ->format('webp');
                $this->addMediaConversion('mail')
                    ->fit(Manipulations::FIT_CROP, 50, 50)
                    ->format('webp');
                $this->addMediaConversion('auth')
                    ->fit(Manipulations::FIT_CROP, 225, 225)
                    ->withResponsiveImages()
                    ->format('webp');
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
            ->format('webp');
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
