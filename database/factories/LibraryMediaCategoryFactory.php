<?php

use App\Models\LibraryMedia\LibraryMediaCategory;
use Faker\Factory;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$fakerFr = Factory::create('fr_FR');
$fakerEn = Factory::create('en_GB');

$factory->define(LibraryMediaCategory::class, function (Faker $faker) use ($fakerFr, $fakerEn) {
    return ['name' => ['fr' => Str::title($fakerFr->word), 'en' => Str::title($fakerEn->word)]];
});
