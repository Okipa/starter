<?php

namespace DynamicPages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DynamicPageBlock extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['position', 'block_id', 'dynamic_page_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dynamicPage(): BelongsTo
    {
        return $this->belongsTo(DynamicPage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return array|string|null
     */
    public function getTranslatedNameAttribute()
    {
        return __(data_get(config("dynamic-pages.blocks.{$this->block_id}", []), 'name'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function html()
    {
        return view(
            "dynamic-pages::templates.front.dynamic-pages.blocks.{$this->block_id}",
            ['blockable' => data_get($this, 'blockable')]
        );
    }
}
