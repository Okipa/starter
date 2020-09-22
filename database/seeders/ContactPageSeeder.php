<?php

namespace Database\Seeders;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\TitleDescriptionPageContent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    /**
     * @throws \Okipa\LaravelBrickables\Exceptions\BrickableCannotBeHandledException
     * @throws \Okipa\LaravelBrickables\Exceptions\InvalidBrickableClassException
     * @throws \Okipa\LaravelBrickables\Exceptions\NotRegisteredBrickableClassException
     */
    public function run(): void
    {
        $faker = Factory::create();
        $pageContent = TitleDescriptionPageContent::create(['unique_key' => 'contact_page_content']);
        $pageContent->saveSeoMeta([
            'meta_title' => ['fr' => 'Nous contacter', 'en' => 'Contact us'],
            'meta_description' => ['fr' => $faker->text(150), 'en' => $faker->text(150)],
        ]);
        $pageContent->addBrick(TitleH1::class, ['title' => ['fr' => 'Nous contacter', 'en' => 'Contact us']]);
        $pageContent->addBrick(OneTextColumn::class, [
            'text' => [
                'fr' => 'Pour toute question, n\'hésitez pas à prendre contact avec notre équipe. '
                    . 'Nous vous recontacterons dans les plus brefs délais.',
                'en' => 'If you have any questions, please contact our team. We will get back to you as soon as '
                    . 'possible.',
            ],
        ]);
    }
}
