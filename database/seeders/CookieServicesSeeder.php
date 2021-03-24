<?php

namespace Database\Seeders;

use App\Models\Cookies\CookieService;
use Illuminate\Database\Seeder;

class CookieServicesSeeder extends Seeder
{
    public function run(): void
    {
        CookieService::factory()->withCategories(['necessary'])->create([
            'unique_key' => 'session',
            'title' => ['fr' => 'Session', 'en' => 'Session'],
            'description' => ['fr' => null, 'en' => null],
            'required' => true,
            'enabled_by_default' => true,
            'cookies' => null,
            'active' => true,
        ]);
        CookieService::factory()->withCategories(['security'])->create([
            'unique_key' => 'csrf-token',
            'title' => ['fr' => 'CSRF token', 'en' => 'Clé CSRF'],
            'description' => ['fr' => null, 'en' => null],
            'required' => true,
            'enabled_by_default' => true,
            'cookies' => null,
            'active' => true,
        ]);
        CookieService::factory()->withCategories(['statistic'])->create([
            'unique_key' => 'google-analytics',
            'title' => ['fr' => 'Google Analytics', 'en' => 'Google Analytics'],
            'description' => ['fr' => null, 'en' => null],
            'required' => false,
            'enabled_by_default' => true,
            'cookies' => [
                ['/^_ga.*$/'],
                ['/^_gid.*$/'],
                ['/^_gat.*$/'],
                ['/^_gac.*$/'],
                ['/^AMP_TOKEN.*$/'],
            ],
            'active' => true,
        ]);
    }
}
