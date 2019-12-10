<?php

namespace App\Models\DynamicPages;

class TwoColumnsParagraph extends Blockable
{

    protected $table    = 'dynamic_page_block_two_columns_paragraph';
    protected $fillable = [ 'content_left', 'content_right' ];
}
