<?php

namespace DynamicPages\Models\Blockables;

class Text extends Blockable
{

    protected $table    = 'dynamic_page_block_text';
    protected $fillable = [ 'content' ];
}
