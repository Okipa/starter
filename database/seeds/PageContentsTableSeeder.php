<?php

use App\Models\PageContent;
use App\Services\Seo\SeoService;
use Illuminate\Database\Seeder;

class PageContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $this->createPageContent(
            'contact-page-content',
            [
                'title' => [
                    'fr' => 'Contact',
                    'en' => 'Contact',
                ],
                'description' => [
                    'fr' => 'Pour toute question, contactez-nous à l\'aide de notre formulaire de contact.',
                    'en' => 'Please use our contact form if you have any question.',
                ],
            ],
            [
                'meta_title' => [
                    'fr' => 'Contact',
                    'en' => 'Contact',
                ],
                'meta_description' => [
                    'fr' => 'Pour toute question, contactez-nous à l\'aide de notre formulaire de contact.',
                    'en' => 'Please use our contact form if you have any question.',
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
