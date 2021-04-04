<?php

namespace Database\Factories\Pages;

use App\Brickables\Carousel;
use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Brickables\CarouselBrickSlide;
use App\Models\Pages\PageContent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageContentFactory extends Factory
{
    /** @var string */
    protected $model = PageContent::class;

    protected array $titles = ['home_page_content' => ['fr' => 'Bienvenue', 'en' => 'Welcome']];

    protected array $descriptions = [
        'home_page_content' => [
            'fr' => <<<EOT
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
EOT,
            'en' => <<<EOT
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
EOT,
        ],
    ];

    public function definition(): array
    {
        return [];
    }

    public function home(): Factory
    {
        return $this->afterMaking(function (PageContent $content) {
            $content->unique_key = 'home_page_content';
        });
    }

    public function withBricks(): Factory
    {
        return $this->afterCreating(function (PageContent $content) {
            $carouselBrick = $content->addBrick(Carousel::class, ['full_width' => true]);
            $slidesCount = random_int(1, 3);
            for ($ii = 1; $ii <= $slidesCount; $ii++) {
                $slide = CarouselBrickSlide::create([
                    'brick_id' => $carouselBrick->id,
                    'label' => [
                        'fr' => Str::title($this->faker->words(random_int(1, 3), true)),
                        'en' => Str::title($this->faker->words(random_int(1, 3), true)),
                    ],
                    'caption' => [
                        'fr' => Str::title($this->faker->words(random_int(4, 7), true)),
                        'en' => Str::title($this->faker->words(random_int(4, 7), true)),
                    ],
                    'active' => true,
                ]);
                $slide->addMedia($this->faker->image(null, 2560, 700))
                    ->toMediaCollection('images');
            }
            $content->addBrick(TitleH1::class, [
                'title' => [
                    'fr' => $this->titles[$content->unique_key]['fr'],
                    'en' => $this->titles[$content->unique_key]['en'],
                ],
            ]);
            $content->addBrick(OneTextColumn::class, [
                'text' => [
                    'fr' => $this->descriptions[$content->unique_key]['fr'],
                    'en' => $this->descriptions[$content->unique_key]['en'],
                ],
            ]);
        });
    }

    public function withSeoMeta(): Factory
    {
        return $this->afterCreating(function (PageContent $content) {
            $content->saveSeoMeta([
                'meta_title' => [
                    'fr' => $this->titles[$content->unique_key]['fr'],
                    'en' => $this->titles[$content->unique_key]['en'],
                ],
                'meta_description' => [
                    'fr' => $this->descriptions[$content->unique_key]['fr'],
                    'en' => $this->descriptions[$content->unique_key]['en'],
                ],
            ]);
        });
    }
}
