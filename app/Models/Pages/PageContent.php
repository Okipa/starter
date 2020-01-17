<?php

namespace App\Models\Pages;

use App\Models\Metable;

class PageContent extends Metable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'page_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
    ];
}
