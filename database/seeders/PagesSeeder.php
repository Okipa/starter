<?php

namespace Database\Seeders;

use App\Models\Pages\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /** @throws \Exception */
    public function run(): void
    {
        Page::factory()->withTitleBrick()->withOneTextColumnBrick()->withSeoMeta()->create([
            'unique_key' => 'terms_of_service_page',
            'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
        ]);
        Page::factory()->withTitleBrick()->withOneTextColumnBrick()->withSeoMeta()->create([
            'unique_key' => 'gdpr_page',
            'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
        ]);
        Page::factory()->withTitleBrick()->withOneTextColumnBrick()->withSeoMeta()->count(3)->create();
    }
}
