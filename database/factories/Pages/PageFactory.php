<?php

namespace Database\Factories\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /** @var string */
    protected $model = Page::class;

    protected string $markdownText = <<<EOT
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

    public function definition(): array
    {
        return [
            'unique_key' => null,
            'slug' => null,
            'nav_title' => ['fr' => $this->faker->catchPhrase, 'en' => $this->faker->catchPhrase],
            'active' => true,
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (Page $page) {
            $page->unique_key = $page->unique_key
                ?: Str::snake(Str::slug($page->getTranslation('nav_title', 'en'), '_'));
            $page->slug = $page->slug
                ?: [
                    'fr' => Str::slug($page->getTranslation('nav_title', 'fr')),
                    'en' => Str::slug($page->getTranslation('nav_title', 'en')),
                ];
        })->afterCreating(function (Page $page) {
            $navTitle = [
                'fr' => $page->getTranslation('nav_title', 'fr'),
                'en' => $page->getTranslation('nav_title', 'en'),
            ];
            $page->addBrick(TitleH1::class, ['title' => $navTitle]);
            $page->addBrick(OneTextColumn::class, [
                'text' => [
                    'fr' => $this->markdownText,
                    'en' => $this->markdownText,
                ],
            ]);
            $page->saveSeoMeta([
                'meta_title' => $navTitle,
                'meta_description' => ['fr' => $this->faker->text(150), 'en' => $this->faker->text(150)],
            ]);
        });
    }
}
