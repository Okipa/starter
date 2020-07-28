<?php

use App\Models\News\NewsArticle;
use Illuminate\Database\Seeder;

class NewsArticlesSeeder extends Seeder
{
    public function run(): void
    {
        for ($ii = 0; $ii <= 5; $ii++) {
            factory(NewsArticle::class)->create();
        }
    }
}
