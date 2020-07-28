<?php

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        factory(NewsCategory::class)->create(['name' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        factory(NewsCategory::class)->create(['name' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        factory(NewsCategory::class)->create(['name' => ['fr' => 'Site internet', 'en' => 'Website']]);
        factory(NewsCategory::class)->create(['name' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
        for ($ii = 0; $ii <= 5; $ii++) {
            factory(NewsCategory::class)->create();
        }
    }
}
