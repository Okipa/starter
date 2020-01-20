<?php

use App\Models\Pages\PageContent;
use App\Services\Seo\SeoService;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $fakerFr = Factory::create('fr_EN');
        $fakerEn = Factory::create('en_GB');
        $pageContent = (new PageContent)->create(['slug' => 'contact-page-content']);
        $pageContent->setMeta('title', ['fr' => 'Contact', 'en' => 'Contact']);
        $pageContent->setMeta('description', [
            'fr' => 'Pour toute question, n\'hésitez pas à prendre contact avec notre équipe. '
                . 'Nous vous recontacterons dans les plus brefs délais.',
            'en' => 'If you have any questions, please contact our team. We will get back to you as soon as possible.',
        ]);
        (new SeoService)->saveSeoTags($pageContent, [
            'meta_title' => ['fr' => 'Contact', 'en' => 'Contact'],
            'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
        ]);
    }
}
