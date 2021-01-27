<?php

namespace Tests\Feature;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
use App\Models\Pages\PageContent;
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
        Settings::factory()->create();
    }

    /** @test */
    public function it_can_access_to_home_page(): void
    {
        PageContent::create(['unique_key' => 'home_page_content']);
        $this->get(route('home.page.show'))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_news_page(): void
    {
        PageContent::create(['unique_key' => 'news_page_content']);
        NewsCategory::factory()->create();
        NewsArticle::factory()->create();
        $this->get(route('news.page.show'))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_news_detail_page(): void
    {
        PageContent::create(['unique_key' => 'news_page_content']);
        NewsCategory::factory()->create();
        $news = NewsArticle::factory()->create();
        $this->get(route('news.article.show', $news))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_contact_page(): void
    {
        PageContent::create(['unique_key' => 'contact_page_content']);
        $this->get(route('news.page.show'))->assertStatus(200);
    }
}
