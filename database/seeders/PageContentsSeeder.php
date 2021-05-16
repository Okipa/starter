<?php

namespace Database\Seeders;

use App\Models\PageContents\PageContent;
use Database\Factories\Brickables\ColoredBackgroundContainerBrickFactory;
use Illuminate\Database\Seeder;

class PageContentsSeeder extends Seeder
{
    public function __construct(protected \Faker\Generator $faker)
    {
        //
    }

    /**
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run(): void
    {
        PageContent::factory()->home()
            ->withCarouselBrick()
            ->withTitleBrick()
            ->withTwoTextColumnsBrick()
            ->withColoredBackgroundContainerBrick(fn(ColoredBackgroundContainerBrickFactory $factory) => $factory
                ->withTitleBrick('h2', 'h2')
                ->withOneTextColumnBrick())
            ->withTitleBrick('h3', 'h3')
            ->withOneColumnTextOneColumnImageBrick()
            ->withOneColumnTextOneColumnImageBrick(invertOrder: true)
            ->withOneColumnTextOneColumnImageBrick()
            ->withOneColumnTextOneColumnImageBrick(invertOrder: true)
            ->withSeoMeta()
            ->create();
        PageContent::factory()
            ->news()
            ->withTitleBrick()
            ->withThreeTextColumnsBrick()
            ->withSeoMeta()
            ->create();
        PageContent::factory()
            ->contact()
            ->withTitleBrick()
            ->withOneTextColumnBrick()
            ->withSeoMeta()
            ->create();
    }
}
