<?php

namespace App\Models\DynamicPages;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ParagraphImage extends Blockable
{

    use HasMediaTrait;

    protected $table    = 'dynamic_page_block_paragraph_image';
    protected $fillable = [ 'content' ];
}
