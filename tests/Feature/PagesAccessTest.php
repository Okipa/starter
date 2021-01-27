<?php

namespace Tests\Feature;

use App\Models\News\NewsArticle;
use App\Models\News\NewsCategory;
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
        $this->artisan('db:seed --class=HomePageSeeder');
        $this->get(route('home.page.show'))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_news_page(): void
    {
        $this->artisan('db:seed --class=NewsPageSeeder');
        NewsCategory::factory()->create();
        NewsArticle::factory()->create();
        $this->get(route('news.page.show'))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_news_detail_page(): void
    {
        $this->artisan('db:seed --class=NewsPageSeeder');
        NewsCategory::factory()->create();
        $news = NewsArticle::factory()->create();
        $this->get(route('news.article.show', $news))->assertStatus(200);
    }

    /** @test */
    public function it_can_access_to_contact_page(): void
    {
        $this->artisan('db:seed --class=ContactPageSeeder');
        $this->get(route('news.page.show'))->assertStatus(200);
    }
}
