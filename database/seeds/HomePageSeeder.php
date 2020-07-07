<?php

use App\Brickables\Carousel;
use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\PageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run(): void
    {
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
        $fakerFr = Factory::create('fr_FR');
        $fakerEn = Factory::create('en_GB');
        /** @var \App\Models\Pages\PageContent $pageContent */
        $pageContent = (new PageContent)->create(['slug' => 'home-page-content']);
        $pageContent->saveSeoMeta([
            'meta_title' => ['fr' => 'Accueil', 'en' => 'Home'],
            'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
        ]);
        /** @var \App\Models\Brickables\CarouselBrick $carouselBrick */
        $carouselBrick = $pageContent->addBrick(Carousel::class, ['full_width' => true]);
        $carouselBrick->addMedia(database_path('seeds/files/home/2251x1600.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'label' => ['fr' => 'Titre #1', 'en' => 'Label #1'],
                'caption' => ['fr' => 'Description #1', 'en' => 'Caption #1'],
            ])
            ->toMediaCollection('slides');
        $carouselBrick->addMedia(database_path('seeds/files/home/2265x1500.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'label' => ['fr' => 'Titre #2', 'en' => 'Label #2'],
                'caption' => ['fr' => 'Description #2', 'en' => 'Caption #2'],
            ])
            ->toMediaCollection('slides');
        $carouselBrick->addMedia(database_path('seeds/files/home/5306x3770.jpg'))
            ->preservingOriginal()
            ->withCustomProperties([
                'label' => ['fr' => 'Titre #3', 'en' => 'Label #3'],
                'caption' => ['fr' => 'Description #3', 'en' => 'Caption #3'],
            ])
            ->toMediaCollection('slides');
        $pageContent->addBrick(TitleH1::class, ['title' => ['fr' => 'Bienvenue', 'en' => 'Welcome']]);
        $pageContent->addBrick(OneTextColumn::class, ['text' => ['fr' => $fakeText, 'en' => $fakeText]]);
    }
}
