<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->call('cache:clear');
        $this->command->call('queue:flush');
        $this->command->call('queue:restart');
        File::cleanDirectory(storage_path('app/public'));
        if (app()->environment() !== 'local') {
            config()->set('medialibrary.queued_conversions', true);
        }
        $this->call(SettingsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(LibraryMediaCategoriesTableSeeder::class);
        $this->call(HomePageTableSeeder::class);
        $this->call(NewsPageTableSeeder::class);
        $this->call(NewsCategoriesTableSeeder::class);
        $this->call(NewsArticlesTableSeeder::class);
        $this->call(ContactPageTableSeeder::class);
    }
}
