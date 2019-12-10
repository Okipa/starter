<?php

namespace App\Models\DynamicPages;

class Paragraph extends Blockable
{

    protected $table    = 'dynamic_page_block_paragraph';
    protected $fillable = [ 'content' ];
}
