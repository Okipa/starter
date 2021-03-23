<?php

namespace Database\Seeders;

use App\Models\Cookies\CookieService;
use Illuminate\Database\Seeder;

class CookieServicesSeeder extends Seeder
{
    public function run(): void
    {
        $host = request()->getHost();
        $cookieService = CookieService::factory()->withCategories(['Statistic'])->create([
            'unique_key' => 'google-analytics',
            'title' => ['fr' => 'Google Analytics', 'en' => 'Google Analytics'],
            'description' => null,
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
