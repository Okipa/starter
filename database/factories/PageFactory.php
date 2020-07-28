<?php

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\Page;
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

$fakeText = <<<EOT
**Bold text.**

*Italic text.*

# Title 1
## Title 2
### Title 3
#### Title 4
##### Title 5
###### Title 6

> Quote.

Unordered list :
* Item 1.
* Item 2.

Ordered list :
1. Item 1.
2. Item 2.

[Link](http://www.google.com).
EOT;

$factory->define(Page::class, function (Faker $faker) use ($fakerFr, $fakerEn) {
    return [
        'unique_key' => null,
        'slug' => null,
        'nav_title' => ['fr' => $fakerFr->catchPhrase, 'en' => $fakerEn->catchPhrase],
        'active' => true,
    ];
});

$factory->afterMaking(Page::class, function (Page $page, Faker $faker) {
    $page->unique_key = $page->unique_key ?: Str::snake(Str::slug($page->getTranslation('nav_title', 'en'), '_'));
    $page->slug = $page->slug
        ?: [
            'fr' => Str::slug($page->getTranslation('nav_title', 'fr')),
            'en' => Str::slug($page->getTranslation('nav_title', 'en')),
        ];
});

$factory->afterCreating(Page::class, function (Page $page, Faker $faker) use ($fakerFr, $fakerEn, $fakeText) {
    $navTitle = [
        'fr' => $page->getTranslation('nav_title', 'fr'),
        'en' => $page->getTranslation('nav_title', 'en'),
    ];
    $page->addBrick(TitleH1::class, ['title' => $navTitle]);
    $page->addBrick(OneTextColumn::class, ['text' => ['fr' => $fakeText, 'en' => $fakeText]]);
    $page->saveSeoMeta([
        'meta_title' => $navTitle,
        'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
    ]);
});
