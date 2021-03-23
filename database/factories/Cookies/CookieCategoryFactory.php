<?php

namespace Database\Factories\Cookies;

use App\Models\Cookies\CookieCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CookieCategoryFactory extends Factory
{
    /** @var string */
    protected $model = CookieCategory::class;

    public function definition(): array
    {
        return [
            'title' => ['fr' => $this->faker->catchPhrase, 'en' => $this->faker->catchPhrase],
            'description' => ['fr' => $this->faker->realText(), 'en' => $this->faker->realText()],
        ];
    }
}
