<?php

namespace DynamicPages\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DynamicPageBlock extends Model
{

    protected $fillable = [ 'position', 'block_id', 'dynamic_page_id' ];

    public function dynamicPage(): BelongsTo
    {
        return $this->belongsTo(DynamicPage::class);
    }

    public function blockable(): MorphTo
    {
        return $this->morphTo();
    }
}
