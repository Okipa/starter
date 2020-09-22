<?php

namespace App\Models\Pages;

use App\Models\Abstracts\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Seo implements HasBrickables
{
    use HasFactory;
    use HasTranslations;
    use HasBrickablesTrait;

    public array $translatable = ['slug', 'nav_title'];

    /** @var string $table */
    protected $table = 'pages';

    /** @var array $fillable */
    protected $fillable = ['unique_key', 'nav_title', 'slug', 'active'];

    /** @var array $cast */
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
