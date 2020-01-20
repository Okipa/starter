<?php

namespace App\Models\News;

use App\Models\Metable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Translatable\HasTranslations;

class NewsArticle extends Metable implements HasMedia
{
    use HasMediaTrait;
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = ['url', 'title', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'description',
        'active',
        'published_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Get the value of the model's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->getTranslation('url', app()->getLocale());
    }

    /** @inheritDoc */
    public function resolveRouteBinding($value)
    {
        /** @var \App\Models\News\NewsArticle $newArticle */
        $newArticle = $this->where('url->' . app()->getLocale(), $value)->firstOrFail();

        return $newArticle;
    }

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('illustrations')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('cover')
                    ->fit(Manipulations::FIT_CROP, 1140, 500)
                    ->withResponsiveImages()
                    ->keepOriginalImageFormat();
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 350, 250)
                    ->keepOriginalImageFormat();
            });
    }

    /**
     * Register the media conversions.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_article_category')->withTimestamps();
    }

    /**
     * @return mixed
     */
    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }
}
