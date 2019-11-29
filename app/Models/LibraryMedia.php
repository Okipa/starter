<?php

namespace App\Models;

use Illuminate\Support\Str;
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
            // todo : only keep mime types you need here
            // check complete list here : https://slick.pl/kb/htaccess/complete-list-mime-types/
            // image
            'image/jpeg',
            'image/png',
            // pdf
            'application/pdf',
            // libre office
            'application/vnd.oasis.opendocument.presentation',
            'application/vnd.oasis.opendocument.spreadsheet',
            'application/vnd.oasis.opendocument.text',
            // open office
            'application/vnd.sun.xml.calc',
            'application/vnd.sun.xml.draw',
            'application/vnd.sun.xml.impress',
            'application/vnd.sun.xml.math',
            'application/vnd.sun.xml.writer',
            // microsoft office
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/x-mspublisher',
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
            'video/mpeg',
            'video/x-msvideo',
            'video/x-m4v',
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

    // attributes ******************************************************************************************************

    /**
     * @return string
     */
    public function getTypeAttribute(): string
    {
        $media = $this->getFirstMedia('medias');
        if (Str::contains($media->mime_type, 'image')) {
            return 'image';
        } elseif (Str::contains($media->mime_type, 'pdf')) {
            return 'pdf';
        } elseif (Str::contains($media->mime_type, 'audio')) {
            return 'audio';
        } elseif (Str::contains($media->mime_type, 'video')) {
            return 'video';
        } else {
            return 'file';
        }
    }

    /**
     * @return string
     */
    public function getIconAttribute(): string
    {
        return config('library-media.icons.' . $this->type);
    }

    /**
     * @return bool
     */
    public function getDownloadableAttribute(): bool
    {
        return $this->type === 'file' ? true : ($this->downloadable ?? false);
    }
}
