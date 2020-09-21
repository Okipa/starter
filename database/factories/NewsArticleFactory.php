<?php

namespace Database\Factories;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;

class NewsArticleFactory extends Factory
{
    protected string $model = NewsArticle::class;

    protected $fakerFr;

    protected $fakerEn;

    protected array $images = ['1-2560x1440.jpg', '2-2560x1769.jpg'];

    protected $fakeText = <<<EOT
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
        $this->fakerFr = $this->create('fr_FR');
        $this->fakerEn = $this->create('en_GB');

        return [
            'slug' => null,
            'title' => ['fr' => $this->fakerFr->catchPhrase, 'en' => $this->fakerEn->catchPhrase],
            'description' => ['fr' => $this->fakeText, 'en' => $this->fakeText],
            'active' => true,
            'published_at' => Carbon::now(),
        ];
    }

    public function configure(): self
    {
        return $this->afterMaking(function (NewsArticle $page) {
            $page->slug = $page->slug
                ?: [
                    'fr' => Str::slug($page->getTranslation('title', 'fr')),
                    'en' => Str::slug($page->getTranslation('title', 'en')),
                ];
        })->afterCreating(function (NewsArticle $newsArticle) {
            $imagePath = $this->images[array_rand($this->images, 1)];
            $newsArticle->addMedia(database_path('seeders/files/news/' . $imagePath))
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
                    'fr' => $this->fakerFr->text(150),
                    'en' => $this->fakerEn->text(150),
                ],
            ]);
        }
        );
    }
}

