<?php

namespace App\Models\DynamicPages;

use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class ParagraphImage extends Blockable implements HasMedia
{

    use HasMediaTrait;

    protected $table    = 'dynamic_page_block_paragraph_image';
    protected $fillable = [ 'content' ];

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('paragraph_images')
            ->acceptsMimeTypes([ 'image/jpeg', 'image/png' ]);
    }
}
