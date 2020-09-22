<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        NewsCategory::factory()->create(['name' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        NewsCategory::factory()->create(['name' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        NewsCategory::factory()->create(['name' => ['fr' => 'Site internet', 'en' => 'Website']]);
        NewsCategory::factory()->create(['name' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
        NewsCategory::factory()->count(6)->create();
    }
}
