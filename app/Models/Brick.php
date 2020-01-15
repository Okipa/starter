<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Brick extends \Okipa\LaravelBrickables\Models\Brick
{
    use HasTranslations;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = ['data'];
}
