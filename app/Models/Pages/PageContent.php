<?php

namespace App\Models\Pages;

use App\Brickables\Carousel;
use App\Brickables\TitleH1;
use App\Models\Abstracts\Seo;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;

class PageContent extends Seo implements HasBrickables
{
    use HasBrickablesTrait;

    public array $brickables = [
        'numberOfBricks' => [
            TitleH1::class => ['min' => 1, 'max' => 1],
            Carousel::class => ['max' => 1],
        ],
    ];

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
    protected $fillable = ['unique_key'];
}
