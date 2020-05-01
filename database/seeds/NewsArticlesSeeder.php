<?php

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class NewsArticlesSeeder extends Seeder
{
    protected \Faker\Generator $fakerFr;

    protected \Faker\Generator $fakerEn;

    protected Collection $categories;

    protected string $fakeText = <<<EOT
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

    protected array $images = ['seeds/files/news/article-2560-1440.jpg', 'seeds/files/news/article-2560-1769.jpg'];

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run(): void
    {
        $this->fakerFr = Factory::create('fr_FR');
        $this->fakerEn = Factory::create('en_GB');
        $this->categories = NewsCategory::all();
        for ($ii = 1; $ii <= 10; $ii++) {
            $this->createArticle();
        }
    }

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function createArticle(): void
    {
        $titleFr = ucfirst($this->fakerFr->words(3, true)) . ' FR';
        $titleEn = ucfirst($this->fakerEn->words(3, true)) . ' EN';
        /** @var \App\Models\News\NewsArticle $article */
        $article = (new NewsArticle)->create([
            'url' => [
                'fr' => Str::slug($titleFr),
                'en' => Str::slug($titleEn),
            ],
            'title' => [
                'fr' => $titleFr,
                'en' => $titleEn,
            ],
            'description' => [
                'fr' => $this->fakeText,
                'en' => $this->fakeText,
            ],
            'active' => true,
            'published_at' => Carbon::now(),
        ]);
        $imageUrl = $this->images[array_rand($this->images, 1)];
        $article->addMedia(database_path($imageUrl))->preservingOriginal()->toMediaCollection('illustrations');
        $categoryIds = $this->categories->random(rand(1, $this->categories->count() / 3))->pluck('id');
        $article->categories()->sync($categoryIds);
        $article->saveSeoMeta([
            'meta_title' => [
                'fr' => $titleFr,
                'en' => $titleEn,
            ],
            'meta_description' => [
                'fr' => $this->fakerFr->text(150),
                'en' => $this->fakerEn->text(150),
            ],
        ]);
    }
}
