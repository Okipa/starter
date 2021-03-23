<?php

namespace App\Models\Cookies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class CookieService extends Model implements Sortable
{
    use HasFactory;
    use HasTranslations;
    use SortableTrait;

    public array $translatable = ['title', 'description'];

    public array $sortable = ['order_column_name' => 'position', 'sort_when_creating' => true];

    /** @var string */
    protected $table = 'cookie_services';

    /** @var array */
    protected $fillable = [
        'unique_key',
        'title',
        'description',
        'cookies',
        'required',
        'enabled_by_default',
        'position',
        'active',
    ];

    /** @var array */
    protected $casts = ['cookies' => 'json'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CookieCategory::class, 'cookie_service_category')->withTimestamps();
    }

    public function getCategoryIdsAttribute(): array
    {
        return $this->categories->pluck('id')->toArray();
    }
}
