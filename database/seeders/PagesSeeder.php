<?php

namespace Database\Seeders;

use App\Models\Pages\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    use HasFactory;

    public function run(): void
    {
        (new Page)->factory()->make([
            'unique_key' => 'terms_of_service_page',
            'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
        ]);
        (new Page)->factory()->make([
            'unique_key' => 'gdpr_page',
            'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
        ]);
        (new Page)->factory()->count(3)->make();
    }
}
