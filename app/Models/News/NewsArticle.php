<?php

namespace App\Models\News;

use App\Models\Abstracts\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Parsedown;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class NewsArticle extends Seo implements HasMedia, Feedable
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['slug', 'title', 'description'];

    /** @var string $table */
    protected $table = 'news_articles';

    /** @var array $fillable */
    protected $fillable = ['title', 'slug', 'description', 'active', 'published_at'];

    /** @var array $cast */
    protected $casts = ['active' => 'boolean', 'published_at' => 'datetime'];

    public static function getFeedItems(): Collection
    {
        return self::orderBy('published_at', 'desc')->with(['media', 'categories'])->get();
    }

    public function getRouteKey(): string
    {
        return $this->getTranslation('slug', app()->getLocale());
    }

    /**
     * @param mixed $value
     * @param null $field
     *
     * @return \App\Models\News\NewsArticle|null
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function resolveRouteBinding($value, $field = null): ?NewsArticle
    {
        return $this->where('slug->' . app()->getLocale(), $value)->first();
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    public function registerMediaCollections(): void
    {
        parent::registerMediaCollections();
        $this->addMediaCollection('illustrations')
            ->singleFile()
            ->acceptsMimeTypes(['image/webp', 'image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('cover')
                    ->fit(Manipulations::FIT_CROP, 1140, 500)
                    ->withResponsiveImages()
                    ->format('webp')
                    ->nonQueued();
                $this->addMediaConversion('card')
                    ->fit(Manipulations::FIT_CROP, 350, 250)
                    ->withResponsiveImages()
                    ->format('webp')
                    ->nonQueued();
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

        return FeedItem::create()->id((string) $this->id)
            ->title($this->title)
            ->summary(Str::limit(strip_tags((new Parsedown)->text($this->description))))
            ->updated($this->updated_at)
            ->link(route('news.article.show', $this->slug))
            ->author(config('app.name'))
            ->category($this->categories->pluck('name'))
            ->enclosure($media->getUrl())
            ->enclosureType($media->mime_type)
            ->enclosureLength($media->size)
            ->updated($this->updated_at);
    }
}
