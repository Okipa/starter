<?php

use App\Models\News\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        (new NewsCategory)->create(['name' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Site vitrine', 'en' => 'Showcase site']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Site catalogue', 'en' => 'Catalog site']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Identité visuelle', 'en' => 'Visual identity']]);
        (new NewsCategory)->create(['name' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
    }
}
