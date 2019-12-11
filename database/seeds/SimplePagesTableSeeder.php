<?php

use App\Models\SimplePage;
use App\Services\Seo\SeoService;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SimplePagesTableSeeder extends Seeder
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
        $this->createSimplePage(
            [
                'slug' => 'terms-of-service-page',
                'active' => true
            ],
            [
                'url' => [
                    'fr' => 'cgu-et-mentions-legales',
                    'en' => 'terms-and-legal-notice',
                ],
                'title' => [
                    'fr' => 'CGU et mentions légales',
                    'en' => 'Terms and legal notice',
                ],
                'description' => [
                    'fr' => $this->fakeText,
                    'en' => $this->fakeText,
                ],
            ],
            [
                'meta_title' => [
                    'fr' => 'CGU et mentions légales',
                    'en' => 'Terms and legal notice',
                ],
                'meta_description' => [
                    'fr' => $this->fakerFr->text(150),
                    'en' => $this->fakerEn->text(150),
                ]
            ]
        );
        $this->createSimplePage(
            [
                'slug' => 'gdpr-page',
                'active' => true
            ],
            [
                'url' => [
                    'fr' => 'respect-vie-privee-rgpd',
                    'en' => 'privacy-policy-gdpr',
                ],
                'title' => [
                    'fr' => 'Respect de la vie privée - RGPD',
                    'en' => 'Privacy policy - GDPR',
                ],
                'description' => [
                    'fr' => $this->fakeText,
                    'en' => $this->fakeText,
                ],
            ],
            [
                'meta_title' => [
                    'fr' => 'CGU et mentions légales',
                    'en' => 'Terms and legal notice',
                ],
                'meta_description' => [
                    'fr' => $this->fakerFr->text(150),
                    'en' => $this->fakerEn->text(150),
                ]
            ]
        );
    }

    /**
     * @param array $data
     * @param array $translatableData
     * @param array $seoTags
     */
    protected function createSimplePage(array $data, array $translatableData, array $seoTags): void
    {
        /** @var SimplePage $simplePage */
        $simplePage = (new SimplePage)->fill($data);
        foreach ($translatableData as $key => $values) {
            $simplePage->setTranslations($key, $values);
        }
        $simplePage->save();
        (new SeoService)->saveSeoTags($simplePage, $seoTags);
    }
}
