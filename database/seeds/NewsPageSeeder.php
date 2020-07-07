<?php

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\TitleDescriptionPageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class NewsPageSeeder extends Seeder
{
    /**
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function run(): void
    {
        $fakerFr = Factory::create('fr_FR');
        $fakerEn = Factory::create('en_GB');
        /** @var \App\Models\Pages\TitleDescriptionPageContent $pageContent */
        $pageContent = (new TitleDescriptionPageContent)->create(['unique_key' => 'news_page_content']);
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
