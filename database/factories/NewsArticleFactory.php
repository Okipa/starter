<?php

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
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

$images = ['1-2560x1440.jpg', '2-2560x1769.jpg'];

$factory->define(NewsArticle::class, function (Faker $faker) use ($fakerFr, $fakerEn, $fakeText) {
    return [
        'slug' => null,
        'title' => ['fr' => $fakerFr->catchPhrase, 'en' => $fakerEn->catchPhrase],
        'description' => ['fr' => $fakeText, 'en' => $fakeText],
        'active' => true,
        'published_at' => Carbon::now(),
    ];
});

$factory->afterMaking(NewsArticle::class, function (NewsArticle $page, Faker $faker) {
    $page->slug = $page->slug
        ?: [
            'fr' => Str::slug($page->getTranslation('title', 'fr')),
            'en' => Str::slug($page->getTranslation('title', 'en')),
        ];
});

$factory->afterCreating(
    NewsArticle::class,
    function (NewsArticle $newsArticle, Faker $faker) use ($fakerFr, $fakerEn, $images) {
        $imagePath = $images[array_rand($images, 1)];
        $newsArticle->addMedia(database_path('seeds/files/news/' . $imagePath))
            ->preservingOriginal()
            ->toMediaCollection('illustrations');
        $categoryIds = (new NewsCategory)->get()->random(rand(1, 2))->pluck('id');
        $newsArticle->categories()->sync($categoryIds);
        $newsArticle->saveSeoMeta([
            'meta_title' => [
                'fr' => $newsArticle->getTranslation('title', 'fr'),
                'en' => $newsArticle->getTranslation('title', 'en'),
            ],
            'meta_description' => [
                'fr' => $fakerFr->text(150),
                'en' => $fakerEn->text(150),
            ],
        ]);
    }
);
