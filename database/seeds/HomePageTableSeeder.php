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
            'title'       => 'Accueil',
            'description' => $faker->text(),
        ]);
        (new SeoService)->saveMetaTags($homePage, [
            'meta_title'       => 'Accueil',
            'meta_description' => $faker->text(150),
        ]);
    }
}
