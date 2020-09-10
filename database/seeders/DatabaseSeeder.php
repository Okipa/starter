<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->call('cache:clear');
        $this->command->call('queue:flush');
        $this->command->call('queue:restart');
        File::cleanDirectory(storage_path('app/public'));
        $this->call(SettingsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(LibraryMediaCategoriesSeeder::class);
        $this->call(HomePageSeeder::class);
        $this->call(NewsPageSeeder::class);
        $this->call(NewsCategoriesSeeder::class);
        $this->call(NewsArticlesSeeder::class);
        $this->call(ContactPageSeeder::class);
    }
}
