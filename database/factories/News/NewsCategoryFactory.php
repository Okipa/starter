<?php

namespace Database\Factories\News;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

// Todo: update this factory if your app is not multilingual.

class NewsCategoryFactory extends Factory
{
    /** @var string */
    protected $model = NewsCategory::class;

    public function definition(): array
    {
        return [
            'name' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }
}
