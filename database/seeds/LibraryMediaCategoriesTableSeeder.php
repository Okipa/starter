<?php

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
    }
}
