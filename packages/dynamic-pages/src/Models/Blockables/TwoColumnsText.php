<?php

namespace DynamicPages\Models\Blockables;

class TwoColumnsText extends Blockable
{
    /**
     * @var string
     */
    protected $table = 'dynamic_page_block_two_columns_text';
    /**
     * @var array
     */
    protected $fillable = ['content_left', 'content_right'];
}
