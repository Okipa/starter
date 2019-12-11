<?php

namespace DynamicPages\Models;

use DynamicPages\Services\DynamicPageBlocks\BlocksService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Plank\Metable\Metable;

class DynamicPage extends Model
{
    use Metable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dynamic_pages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'url',
        'active',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive(Builder $builder)
    {
        return $builder->where('active', true);
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(DynamicPageBlock::class);
    }

    public function getBlocksTableAttribute()
    {
        return (new BlocksService)->table($this);
    }
}
