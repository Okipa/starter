<?php

namespace App\Models\DynamicPages;

class Text extends Blockable
{

    protected $table    = 'dynamic_page_block_text';
    protected $fillable = [ 'content' ];
}
