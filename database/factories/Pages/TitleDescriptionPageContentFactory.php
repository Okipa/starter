<?php

namespace Database\Factories\Pages;

use App\Brickables\OneTextColumn;
use App\Brickables\TitleH1;
use App\Models\Pages\TitleDescriptionPageContent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TitleDescriptionPageContentFactory extends PageContentFactory
{
    /** @var string */
    protected $model = TitleDescriptionPageContent::class;

    protected array $titles = [
        'news_page_content' => [
            'fr' => 'Actualités',
            'en' => 'News',
        ],
        'contact_page_content' => [
            'fr' => 'Contactez-nous',
            'en' => 'Contact Us',
        ],
    ];

    protected array $descriptions = [
        'news_page_content' => [
            'fr' => 'Découvrez ici toutes nos actualités catégorisées. Cliquez sur l\'une des catégories pour '
                . 'filter les actualités.',
            'en' => 'Discover here all our categorized news. Click on one of the categories to filter the news.',
        ],
        'contact_page_content' => [
            'fr' => 'Pour toute question, n\'hésitez pas à prendre contact avec notre équipe. '
                . 'Nous vous recontacterons dans les plus brefs délais.',
            'en' => 'If you have any questions, please contact our team. We will get back to you as soon as '
                . 'possible.',
        ]
    ];

    public function news(): self
    {
        return $this->afterMaking(function (TitleDescriptionPageContent $content) {
            $content->unique_key = 'news_page_content';
        });
    }

    public function contact(): self
    {
        return $this->afterMaking(function (TitleDescriptionPageContent $content) {
            $content->unique_key = 'contact_page_content';
        });
    }

    public function withBricks(): self
    {
        return $this->afterCreating(function (TitleDescriptionPageContent $content) {
            $content->addBrick(TitleH1::class, [
                'title' => [
                    'fr' => $this->titles[$content->unique_key]['fr'],
                    'en' => $this->titles[$content->unique_key]['en'],
                ],
            ]);
            $content->addBrick(OneTextColumn::class, [
                'text' => [
                    'fr' => $this->descriptions[$content->unique_key]['fr'],
                    'en' => $this->descriptions[$content->unique_key]['en'],
                ],
            ]);
        });
    }
}
