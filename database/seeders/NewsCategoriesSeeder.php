<?php

namespace Database\Seeders;

use App\Models\News\NewsCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class NewsCategoriesSeeder extends Seeder
{
    use HasFactory;

    public function run(): void
    {
        (new NewsCategory)->factory()->make(['name' => ['fr' => 'Apps Web', 'en' => 'Web apps']]);
        (new NewsCategory)->factory()->make(['name' => ['fr' => 'Apps mobiles', 'en' => 'Mobile apps']]);
        (new NewsCategory)->factory()->make(['name' => ['fr' => 'Site internet', 'en' => 'Website']]);
        (new NewsCategory)->factory()->make(['name' => ['fr' => 'Graphisme', 'en' => 'Graphism']]);
        (new NewsCategory)->factory()->count(6)->make();
    }
}
