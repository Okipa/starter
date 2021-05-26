<?php

namespace Database\Factories\LibraryMedia;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

// Todo: update this factory if your app is not multilingual.

class LibraryMediaCategoryFactory extends Factory
{
    /** @var string */
    protected $model = LibraryMediaCategory::class;

    public function definition(): array
    {
        return [
            'title' => [
                'fr' => Str::title($this->faker->word),
                'en' => Str::title($this->faker->word),
            ],
        ];
    }
}
