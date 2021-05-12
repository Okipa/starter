<?php

namespace Database\Factories\PageContents;

use App\Models\PageContents\PageContent;
use Database\Factories\Traits\HasBricks;
use Database\Factories\Traits\HasSeoMeta;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageContentFactory extends Factory
{
    use HasSeoMeta;
    use HasBricks;

    /** @var string */
    protected $model = PageContent::class;

    public function definition(): array
    {
        return [];
    }

    public function home(): self
    {
        return $this->afterMaking(function (PageContent $content) {
            $content->unique_key = 'home_page_content';
        });
    }

    public function news(): self
    {
        return $this->afterMaking(function (PageContent $content) {
            $content->unique_key = 'news_page_content';
        });
    }

    public function contact(): self
    {
        return $this->afterMaking(function (PageContent $content) {
            $content->unique_key = 'contact_page_content';
        });
    }
}
