<?php

use App\Models\PageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PageContentsTableSeeder extends Seeder
{
    protected $faker;
    protected $fakeText;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->faker = Factory::create(config('app.faker_locale'));
        $this->fakeText = <<<EOT
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
        $this->createPageContent('contact-page-content', [
            'title_fr'       => 'Contact',
            'title_en'       => 'Contact',
            'description_fr' => 'Contenu page contact.',
            'description_en' => 'Contact page content.',
        ]);
    }

    /**
     * @param string $slug
     * @param array $meta
     */
    protected function createPageContent(string $slug, array $meta): void
    {
        /** @var \App\Models\PageContent $pageContent */
        $pageContent = (new PageContent)->create(['slug' => $slug]);
        foreach ($meta as $key => $value) {
            $pageContent->setMeta($key, $value);
        }
    }
}
