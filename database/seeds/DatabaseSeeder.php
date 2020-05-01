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
