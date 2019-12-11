<?php

namespace App\Models\DynamicPages;

class TwoColumnsText extends Blockable
{

    protected $table    = 'dynamic_page_block_two_columns_text';
    protected $fillable = [ 'content_left', 'content_right' ];
}
