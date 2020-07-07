<?php

namespace App\Models\Pages;

use App\Models\Abstracts\Seo;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Seo implements HasBrickables
{
    use HasTranslations;
    use HasBrickablesTrait;

    public array $translatable = ['slug', 'nav_title'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unique_key', 'nav_title', 'slug', 'active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    public function getRouteKey(): string
    {
        return $this->getTranslation('slug', app()->getLocale());
    }

    /**
     * @param mixed $value
     * @param null $field
     *
     * @return \App\Models\Pages\Page|null
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function resolveRouteBinding($value, $field = null): ?Page
    {
        return $this->where('slug->' . app()->getLocale(), $value)->first();
    }
}
