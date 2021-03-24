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
            'title' => ['fr' => 'Clé CSRF', 'en' => 'CSRF Token'],
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
                '_ga',
                '_gid',
                '_gat',
                'AMP_TOKEN',
                ['^_gac_.*$'],
                '__utma',
                '__utmt',
                '__utmb',
                '__utmc',
                '__utmz',
                '__utmv',
                '__utmx',
                '__utmxx',
                'IDE',
                'DSID',
            ],
            'active' => true,
        ]);
        CookieService::factory()->withCategories(['advertising'])->create([
            'unique_key' => 'twitter-feed',
            'title' => ['fr' => 'Fil Twitter intégré', 'en' => 'Twitter Embed Feed'],
            'description' => ['fr' => null, 'en' => null],
            'required' => false,
            'enabled_by_default' => false,
            'cookies' => [
                'ct0',
                '_twitter_sess',
                'guest_id',
                'personalization_id',
                'external_reference',
                'eu_cn',
                'kdt',
                'lang',
                'remember_check_on',
                'tfw_ex',
            ],
            'active' => false,
        ]);
        CookieService::factory()->withCategories(['advertising'])->create([
            'unique_key' => 'youtube-video',
            'title' => ['fr' => 'Vidéos Youtube intégrées', 'en' => 'Youtube Embed Videos'],
            'description' => ['fr' => null, 'en' => null],
            'required' => false,
            'enabled_by_default' => false,
            'cookies' => [
                'GEUP',
                'PREF',
                'VISITOR_INFO1_LIVE',
                'YSC',
            ],
            'active' => false,
        ]);
    }
}
