<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryMediaCategoryFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaCategory::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return ['name' => ['fr' => Str::title($faker->word), 'en' => Str::title($faker->word)]];
    }
}
