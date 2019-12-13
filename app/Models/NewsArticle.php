<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Image\Exceptions\InvalidManipulation;
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

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return $this->where('url->' . app()->getLocale(), $value)->firstOrFail();
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
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function(Media $media = null) {
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
     *
     * @param Media|null $media
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }

    /**
     * @return BelongsToMany
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
