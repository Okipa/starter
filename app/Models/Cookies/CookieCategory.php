<?php

namespace App\Models\Cookies;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class CookieCategory extends Model implements Sortable
{
    use HasFactory;
    use HasTranslations;
    use SortableTrait;

    public array $translatable = ['title', 'description'];

    public array $sortable = ['order_column_name' => 'position', 'sort_when_creating' => true];

    /** @var string */
    protected $table = 'cookie_categories';

    /** @var array */
    protected $fillable = ['unique_key', 'title', 'description'];

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(CookieService::class, 'cookie_service_category')->withTimestamps();
    }
}
