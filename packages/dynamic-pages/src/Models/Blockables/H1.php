<?php

namespace DynamicPages\Models\Blockables;

class H1 extends Blockable
{
    /**
     * @var string
     */
    protected $table = 'dynamic_page_block_h1';
    /**
     * @var array
     */
    protected $fillable = ['content'];
}
