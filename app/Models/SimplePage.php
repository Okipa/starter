<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class SimplePage extends Metable
{
    use HasTranslations;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'simple_pages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'url',
        'title',
        'description',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    public $translatable = ['url', 'title', 'description'];
}
