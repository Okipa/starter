<?php

namespace Database\Seeders;

use Illuminate\Cache\Console\ClearCommand;
use Illuminate\Database\Seeder;
use Illuminate\Queue\Console\RestartCommand;
use Laravel\Horizon\Console\TerminateCommand;
use Spatie\MediaLibrary\MediaCollections\Commands\CleanCommand;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->call(ClearCommand::class);
        $this->command->call(TerminateCommand::class);
        $this->command->call(RestartCommand::class);
        $this->command->call(CleanCommand::class);
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
