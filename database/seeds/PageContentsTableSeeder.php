<?php

use Faker\Factory;
use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Illuminate\Database\Seeder;

class PageContentsTableSeeder extends Seeder
{
    protected $fakerFr;
    protected $fakerEn;
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

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->fakerFr = Factory::create('fr_EN');
        $this->fakerEn = Factory::create('en_GB');
        $this->createPageContent(
            'home-page-content',
            [
                'title' => [
                    'fr' => 'Accueil',
                    'en' => 'Home',
                ],
                'description' => [
                    'fr' => $this->fakeText,
                    'en' => $this->fakeText,
                ],
            ],
            [
                'meta_title' => [
                    'fr' => 'Accueil',
                    'en' => 'Home',
                ],
                'meta_description' => [
                    'fr' => $this->fakerFr->text(150),
                    'en' => $this->fakerEn->text(150),
                ]
            ]
        );
        $this->createPageContent(
            'contact-page-content',
            [
                'title' => [
                    'fr' => 'Contact',
                    'en' => 'Contact',
                ],
                'description' => [
                    'fr' => $this->fakeText,
                    'en' => $this->fakeText,
                ],
            ],
            [
                'meta_title' => [
                    'fr' => 'Contact',
                    'en' => 'Contact',
                ],
                'meta_description' => [
                    'fr' => $this->fakerFr->text(150),
                    'en' => $this->fakerEn->text(150),
                ]
            ]
        );
    }

    /**
     * @param string $slug
     * @param array $data
     * @param array $seoTags
     */
    protected function createPageContent(string $slug, array $data, array $seoTags): void
    {
        /** @var PageContent $pageContent */
        $pageContent = (new PageContent)->create(['slug' => $slug]);
        foreach ($data as $key => $value) {
            $pageContent->setMeta($key, $value);
        }
        (new SeoService)->saveSeoTags($pageContent, $seoTags);
    }
}
