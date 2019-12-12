<?php

namespace DynamicPages\Models\Blockables;

use App\Models\Model;
use DynamicPages\Models\DynamicPageBlock;
use Illuminate\Database\Eloquent\Relations\MorphOne;

abstract class Blockable extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function block(): MorphOne
    {
        return $this->morphOne(DynamicPageBlock::class, 'blockable');
    }
}
