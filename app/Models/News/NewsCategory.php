<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class NewsCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['name'];

    /** @var string $table */
    protected $table = 'news_categories';

    /** @var array $fillable */
    protected $fillable = ['name'];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(NewsArticle::class, 'news_article_category')->withTimestamps();
    }
}
