<?php

namespace Database\Seeders;

use App\Models\News\NewsArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class NewsArticlesSeeder extends Seeder
{
    use HasFactory;

    public function run(): void
    {
        (new NewsArticle)->factory()->count(5)->create();
    }
}
