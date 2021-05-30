<?php

namespace Tests\Feature\Front;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use App\Models\PageContents\PageContent;
use App\Models\Settings\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesAccessTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        Settings::factory()->withMedia()->create();
    }

    /** @test */
    public function it_can_access_to_home_page(): void
    {
        PageContent::factory()->home()->create();
        $this->get(route('home.page.show'))->assertOk();
    }

    /** @test */
    public function it_can_access_to_news_page(): void
    {
        PageContent::factory()->news()->create();
        NewsCategory::factory()->create();
        NewsArticle::factory()->create();
        $this->get(route('news.page.show'))->assertOk();
    }

    /** @test */
    public function it_can_access_to_news_detail_page(): void
    {
        NewsCategory::factory()->create();
        $news = NewsArticle::factory()->create();
        $this->get(route('news.article.show', $news))->assertOk();
    }
}
