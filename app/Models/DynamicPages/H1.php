<?php

namespace App\Models\DynamicPages;

class H1 extends Blockable
{

    protected $table    = 'dynamic_page_block_h1';
    protected $fillable = [ 'content' ];
}
