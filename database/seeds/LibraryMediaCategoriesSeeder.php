<?php

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        factory(LibraryMediaCategory::class)->create(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        factory(LibraryMediaCategory::class)->create(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
    }
}
