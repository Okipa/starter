<?php

namespace App\Models\Brickables;

use App\Brickables\Carousel;
use App\Brickables\ColoredBackgroundContainer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Okipa\LaravelBrickables\Contracts\HasBrickables;
use Okipa\LaravelBrickables\Models\Brick;
use Okipa\LaravelBrickables\Traits\HasBrickablesTrait;

class ColoredBackgroundContainerBrick extends Brick implements HasBrickables
{
    use HasFactory;
    use HasBrickablesTrait;

    public array $brickables = [
        'number_of_bricks' => [
            ColoredBackgroundContainer::class => ['max' => 0],
            Carousel::class => ['max' => 0],
        ],
    ];
}
