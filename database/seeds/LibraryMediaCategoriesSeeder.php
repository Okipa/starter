<?php

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        (new LibraryMediaCategory)->create(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
    }
}
