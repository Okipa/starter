<?php

use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Faker\Factory;
use Illuminate\Database\Seeder;

class HomePageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
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
        $fakerFr = Factory::create('fr_EN');
        $fakerEn = Factory::create('en_GB');
        $pageContent = (new PageContent)->create(['slug' => 'home-page-content']);
        $pageContent->setMeta('title', ['fr' => 'Accueil', 'en' => 'Home']);
        $pageContent->setMeta('description', ['fr' => $fakeText, 'en' => $fakeText]);
        (new SeoService)->saveSeoTags($pageContent, [
            'meta_title' => ['fr' => 'Accueil', 'en' => 'Home'],
            'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
        ]);
    }
}
