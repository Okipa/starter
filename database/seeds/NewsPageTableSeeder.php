<?php

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\TitleDescriptionPageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NewsPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $fakerFr = Factory::create('fr_FR');
        $fakerEn = Factory::create('en_GB');
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->create(['slug' => 'news-page-content']);
        $pageContent->saveSeoMeta([
            'meta_title' => ['fr' => 'Actualités', 'en' => 'News'],
            'meta_description' => ['fr' => $fakerFr->text(150), 'en' => $fakerEn->text(150)],
        ]);
        $pageContent->addBrick(TitleH1::class, ['title' => ['fr' => 'Actualités', 'en' => 'News']]);
        $pageContent->addBrick(OneTextColumn::class, [
            'text' => [
                'fr' => 'Découvrez ici toutes nos actualités catégorisées. Cliquez sur l\'une des catégories pour '
                    . 'filter les actualités.',
                'en' => 'Discover here all our categorized news. Click on one of the categories to filter the news.',
            ],
        ]);
    }
}
