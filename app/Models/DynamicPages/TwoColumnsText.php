<?php

namespace App\Models\DynamicPages;

use App\Models\DynamicPageBlock;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class TwoColumnsText extends Model
{

    protected $table = 'dynamic_page_block_two_columns_text';

    public function block(): MorphOne
    {
        return $this->morphOne(DynamicPageBlock::class, 'blockable');
    }
}
