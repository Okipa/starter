<?php

namespace DynamicPages\Models\Blockables;

class Text extends Blockable
{
    /**
     * @var string
     */
    protected $table = 'dynamic_page_block_text';
    /**
     * @var array
     */
    protected $fillable = ['content'];
}
