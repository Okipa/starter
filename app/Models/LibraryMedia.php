<?php

namespace App\Models;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class LibraryMedia extends Model implements HasMedia
{
    use HasMediaTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'library_media';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'downloadable',
    ];

    // media ***********************************************************************************************************

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('medias')->acceptsMimeTypes([
            // image
            'image/jpeg',
            'image/png',
            // audio
            'audio/wav',
            'audio/wave',
            'audio/x-wav',
            'audio/mpg',
            'audio/mpeg',
            'audio/mpeg3',
            'audio/mp3',
            'audio/x-flac',
            'audio/ogg',
            'audio/webm',
            'audio/3gpp2',
            'audio/aiff',
            'audio/x-aiff',
            'audio/x-flac',
            // video
            'video/webm',
            'video/ogg',
            'video/mp4',
            'video/mpeg'
        ])->singleFile();
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

    // relationships ***************************************************************************************************

}
