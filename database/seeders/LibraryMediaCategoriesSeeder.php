<?php

namespace Database\Seeders;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        LibraryMediaCategory::factory()->create(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        LibraryMediaCategory::factory()->create(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
        LibraryMediaCategory::factory()->count(3)->create();
    }
}
