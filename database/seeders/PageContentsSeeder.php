<?php

namespace Database\Seeders;

use App\Models\PageContents\PageContent;
use Database\Factories\Brickables\ColoredBackgroundContainerBrickFactory;
use Illuminate\Database\Seeder;

class PageContentsSeeder extends Seeder
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
        // Home page
        PageContent::factory()->home()
            ->withCarouselBrick()
            ->withSpacerBrick('lg')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withTwoTextColumnsBrick()
            ->withSpacerBrick('lg')
            ->withColoredBackgroundContainerBrick(fn(ColoredBackgroundContainerBrickFactory $factory) => $factory
                ->withSpacerBrick('lg')
                ->withTitleBrick('h2', 'h2')
                ->withSpacerBrick('sm')
                ->withOneTextColumnBrick()
                ->withSpacerBrick('lg'))
            ->withSpacerBrick('lg')
            ->withTitleBrick('h3', 'h3')
            ->withSpacerBrick('sm')
            ->withOneColumnTextOneColumnImageBrick()
            ->withSpacerBrick('xs')
            ->withOneColumnTextOneColumnImageBrick(invertOrder: true)
            ->withSpacerBrick('xs')
            ->withOneColumnTextOneColumnImageBrick()
            ->withSpacerBrick('xs')
            ->withOneColumnTextOneColumnImageBrick(invertOrder: true)
            ->withSpacerBrick('xl')
            ->withSeoMeta()
            ->create();
        // News articles list page
        PageContent::factory()
            ->news()
            ->withSpacerBrick('xl')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withThreeTextColumnsBrick()
            ->withSpacerBrick('lg')
            ->withSeoMeta()
            ->create();
        // Contact page
        PageContent::factory()
            ->contact()
            ->withSpacerBrick('xl')
            ->withTitleBrick()
            ->withSpacerBrick('sm')
            ->withOneTextColumnBrick()
            ->withSpacerBrick('lg')
            ->withSeoMeta()
            ->create();
    }
}
