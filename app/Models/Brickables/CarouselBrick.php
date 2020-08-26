<?php

namespace App\Models\Brickables;

use Okipa\LaravelBrickables\Models\Brick;

class CarouselBrick extends Brick
{
    public function slides()
    {
        return $this->hasMany(CarouselBrickSlide::class, 'brick_id')->ordered();
    }
}
