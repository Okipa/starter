<?php

namespace App\Models\News;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NewsCategory extends Model
{
    use HasTranslations;

    public array $translatable = ['name'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(NewsArticle::class, 'news_article_category')->withTimestamps();
    }
}
