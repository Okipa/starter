<?php

use App\Models\HomePage;
use App\Services\Seo\SeoService;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HomePageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(config('app.faker_locale'));
        /** @var \App\Models\HomePage $homePage */
        $homePage = (new HomePage)->create([
            'title' => 'Accueil',
            'description' => $faker->text(),
        ]);
        (new SeoService)->saveSeoTags($homePage, [
            'meta_title' => [
                'fr' => 'Accueil',
                'en' => 'Home'
            ],
            'meta_description' => [
                'fr' => $faker->text(150),
                'en' => $faker->text(150),
            ],
        ]);
    }
}
