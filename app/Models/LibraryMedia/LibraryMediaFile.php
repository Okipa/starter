<?php

namespace App\Models\LibraryMedia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Okipa\MediaLibraryExt\ExtendsMediaAbilities;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class LibraryMediaFile extends Model implements HasMedia
{
    use hasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use ExtendsMediaAbilities;

    public array $translatable = ['name'];

    /** @var string $table */
    protected $table = 'library_media_files';

    /** @var array $fillable */
    protected $fillable = ['category_id', 'name'];

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media')->withResponsiveImages()->acceptsMimeTypes([
            // todo: only keep mime types you need here
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
            'video/x-m4v',
        ])->singleFile();
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

    public function getTypeAttribute(): string
    {
        $media = $this->getFirstMedia('media');
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

    public function getIconAttribute(): string
    {
        return config('library-media.icons.' . $this->type);
    }

    public function getHasPreviewImageAttribute(): bool
    {
        return in_array($this->type, ['image', 'pdf']);
    }

    public function getCanBePreviewedInPopInAttribute(): bool
    {
        return in_array($this->type, ['image', 'pdf', 'audio', 'video']);
    }

    public function getCanBeDisplayedOnPageAttribute(): bool
    {
        return in_array($this->type, ['image', 'pdf', 'audio', 'video']);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(LibraryMediaCategory::class);
    }
}
