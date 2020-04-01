<?php

namespace App\Models\News;

use App\Models\Abstracts\Seo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class NewsArticle extends Seo implements HasMedia, Feedable
{
    use HasTranslations;

    public array $translatable = ['url', 'title', 'description'];

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
    protected $fillable = ['title', 'url', 'description', 'active', 'published_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean', 'published_at' => 'datetime'];

    public static function getFeedItems(): Collection
    {
        return self::orderBy('published_at', 'desc')->get();
    }

    public function getRouteKey(): string
    {
        return $this->getTranslation('url', app()->getLocale());
    }

    /**
     * @param mixed $value
     *
     * @return \App\Models\News\NewsArticle
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function resolveRouteBinding($value): NewsArticle
    {
        return $this->where('url->' . app()->getLocale(), $value)->firstOrFail();
    }

    /** @SuppressWarnings(PHPMD.UnusedLocalVariable) */
    public function registerMediaCollections(): void
    {
        parent::registerMediaCollections();
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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(NewsCategory::class, 'news_article_category')->withTimestamps();
    }

    public function getCategoryIdsAttribute(): array
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function toFeedItem(): FeedItem
    {
        $media = $this->getFirstMedia('illustrations');

        return FeedItem::create()->id($this->id)
            ->title($this->title)
            ->summary($this->description)
            ->updated($this->updated_at)
            ->link(route('news.article.show', $this->url))
            ->author(config('app.name'))
            ->enclosure($media->getUrl())
            ->enclosureType($media->mime_type)
            ->enclosureLength($media->size);
    }
}
