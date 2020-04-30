<?php

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\Page;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    protected \Faker\Generator $fakerFr;

    protected \Faker\Generator $fakerEn;

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

    /**
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function run(): void
    {
        $this->fakerFr = Factory::create('fr_FR');
        $this->fakerEn = Factory::create('en_GB');
        $this->createPage(
            [
                'slug' => 'terms-of-service-page',
                'nav_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
                'active' => true,
                'url' => ['fr' => 'cgu-et-mentions-legales', 'en' => 'terms-and-legal-notice'],
            ],
            [
                [TitleH1::class, ['title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice']]],
                [OneTextColumn::class, ['text' => ['fr' => $this->fakeText, 'en' => $this->fakeText]]],
            ],
            [
                'meta_title' => ['fr' => 'CGU et mentions légales', 'en' => 'Terms and legal notice'],
                'meta_description' => ['fr' => $this->fakerFr->text(150), 'en' => $this->fakerEn->text(150)],
            ]
        );
        $this->createPage(
            [
                'slug' => 'gdpr-page',
                'nav_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
                'active' => true,
                'url' => ['fr' => 'vie-privee-rgpd', 'en' => 'privacy-policy-gdpr'],
            ],
            [
                [TitleH1::class, ['title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR']]],
                [OneTextColumn::class, ['text' => ['fr' => $this->fakeText, 'en' => $this->fakeText]]],
            ],
            [
                'meta_title' => ['fr' => 'Vie privée et RGPD', 'en' => 'Privacy policy and GDPR'],
                'meta_description' => ['fr' => $this->fakerFr->text(150), 'en' => $this->fakerEn->text(150)],
            ]
        );
    }

    /**
     * @param array $data
     * @param array $bricks
     * @param array $seoTags
     *
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    protected function createPage(array $data, array $bricks, array $seoTags): void
    {
        /** @var Page $page */
        $page = (new Page)->create($data);
        $page->addBricks($bricks);
        $page->saveSeoMeta($seoTags);
    }
}
