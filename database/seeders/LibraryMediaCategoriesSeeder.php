<?php

namespace Database\Seeders;

use App\Models\LibraryMedia\LibraryMediaCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class LibraryMediaCategoriesSeeder extends Seeder
{
    use HasFactory;

    public function run(): void
    {
        (new LibraryMediaCategory)->factory()->make(['name' => ['fr' => 'Accueil', 'en' => 'Home']]);
        (new LibraryMediaCategory)->factory()->make(['name' => ['fr' => 'Actualités', 'en' => 'News']]);
        (new LibraryMediaCategory)->factory()->count(3)->make();
    }
}
