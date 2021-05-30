<?php

namespace App\Models\Cookies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class CookieService extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = ['title', 'description'];

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
        'active',
    ];

    /** @var array */
    protected $casts = ['cookies' => 'array'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CookieCategory::class, 'cookie_service_category')->ordered()->withTimestamps();
    }

    public function getCategoryIdsAttribute(): array
    {
        return $this->categories->pluck('id')->toArray();
    }
}
