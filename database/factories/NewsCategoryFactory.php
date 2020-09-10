<?php

namespace Database\Factories;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsCategoryFactory extends Factory
{
    protected string $model = NewsCategory::class;

    public function definition(): array
    {
        $fakerFr = $this->create('fr_FR');
        $fakerEn = $this->create('en_GB');
        return ['name' => ['fr' => Str::title($fakerFr->word), 'en' => Str::title($fakerEn->word)]];
    }
}
