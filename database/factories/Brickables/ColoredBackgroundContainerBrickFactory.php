<?php

namespace Database\Factories\Brickables;

use App\Brickables\ColoredBackgroundContainer;
use App\Models\Brickables\ColoredBackgroundContainerBrick;
use Database\Factories\Traits\HasBricks;
use Illuminate\Database\Eloquent\Factories\Factory;
use Okipa\LaravelBrickables\Contracts\HasBrickables;

class ColoredBackgroundContainerBrickFactory extends Factory
{
    use HasBricks;

    /** @var string */
    protected $model = ColoredBackgroundContainerBrick::class;

    public function definition(): array
    {
        return ['brickable_type' => ColoredBackgroundContainer::class];
    }

    public function relatedToModel(HasBrickables $model): self
    {
        return $this->state(fn() => [
            'model_type' => $model::class,
            'model_id' => $model->id,
        ]);
    }
}
