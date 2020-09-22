<?php

namespace Database\Factories\News;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsCategoryFactory extends Factory
{
    /** @var string */
    protected $model = NewsCategory::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return ['name' => ['fr' => Str::title($faker->word), 'en' => Str::title($faker->word)]];
    }
}
