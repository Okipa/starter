<?php

namespace Database\Seeders;

use App\Models\Pages\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /** @throws \Exception */
    public function run(): void
    {
        Page::factory()
            ->withSpacerBrick('xl')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withOneTextColumnBrick()
            ->withSpacerBrick('xl')
            ->withSeoMeta()
            ->create([
                'unique_key' => 'terms_of_service_page',
                'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
            ]);
        Page::factory()
            ->withSpacerBrick('xl')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withOneTextColumnBrick()
            ->withSpacerBrick('xl')
            ->withSeoMeta()
            ->create([
                'unique_key' => 'gdpr_page',
                'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
            ]);
        Page::factory()
            ->withSpacerBrick('xl')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withOneTextColumnBrick()
            ->withSpacerBrick('xl')
            ->withSeoMeta()
            ->count(3)
            ->create();
    }
}
