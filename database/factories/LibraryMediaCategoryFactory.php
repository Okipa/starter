<?php

namespace Database\Factories;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Faker\Factory;
use Illuminate\Support\Str;

class LibraryMediaCategoryFactory extends Factory
{
    protected string $model = LibraryMediaCategory::class;

    public function definition(): array
    {
        $fakerFr = Factory::create('fr_FR');
        $fakerEn = Factory::create('en_GB');

        return ['name' => ['fr' => Str::title($fakerFr->word), 'en' => Str::title($fakerEn->word)]];
    }
}
