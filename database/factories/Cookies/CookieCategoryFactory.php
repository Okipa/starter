<?php

namespace Database\Factories\Cookies;

use App\Models\Cookies\CookieCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CookieCategoryFactory extends Factory
{
    /** @var string */
    protected $model = CookieCategory::class;

    public function definition(): array
    {
        $titles = ['fr' => $this->faker->unique()->catchPhrase, 'en' => $this->faker->unique()->catchPhrase];

        return [
            'unique_key' => Str::slug($titles['en']),
            'title' => $titles,
            'description' => ['fr' => $this->faker->realText(), 'en' => $this->faker->realText()],
        ];
    }
}
