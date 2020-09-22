<?php

namespace Database\Seeders;

use App\Models\LibraryMedia\LibraryMediaFile;
use Illuminate\Database\Seeder;

class LibraryMediaFilesSeeder extends Seeder
{
    public function run(): void
    {
        LibraryMediaFile::factory()->count(5)->create();
    }
}
