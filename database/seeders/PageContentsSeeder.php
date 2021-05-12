<?php

namespace Database\Seeders;

use App\Brickables\Title;
use App\Brickables\TwoTextColumns;
use App\Models\Brickables\ColoredBackgroundContainerBrick;
use App\Models\PageContents\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageContentsSeeder extends Seeder
{
    public function __construct(protected \Faker\Generator $faker)
    {
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
            ->withOneTextColumnBrick()
            ->withColoredBackgroundContainerBrick(function (
                ColoredBackgroundContainerBrick $coloredBackgroundContainerBrick
            ) {
                $coloredBackgroundContainerBrick->addBrick(Title::class, [
                    'type' => 'h2',
                    'title' => [
                        'fr' => Str::title($this->faker->words(random_int(1, 3), true)),
                        'en' => Str::title($this->faker->words(random_int(1, 3), true)),
                    ],
                ]);
                $coloredBackgroundContainerBrick->addBrick(TwoTextColumns::class, [
                    'text_left' => ['fr' => $this->faker->realText(500), 'en' => $this->faker->realText(500)],
                    'text_right' => ['fr' => $this->faker->realText(500), 'en' => $this->faker->realText(500)],
                ]);
            })
            ->withTitleBrick('h2')
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
