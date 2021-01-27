<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Todo: set settings in seeder.
        Settings::factory()->withMedia()->create();
    }
}
