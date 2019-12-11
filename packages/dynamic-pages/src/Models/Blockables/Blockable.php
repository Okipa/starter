<?php

namespace DynamicPages\Models\Blockables;

use DynamicPages\Models\DynamicPageBlock;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

abstract class Blockable extends Model
{

    public function block(): MorphOne
    {
        return $this->morphOne(DynamicPageBlock::class, 'blockable');
    }
}
