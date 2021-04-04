<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Settings::factory()
            // ToDo: customize logo.
            ->withMedia(['logo_squared' => resource_path('seeds/logo-starter.png')])
            ->create([
                // ToDo: set custom settings.
            ]);
    }
}
