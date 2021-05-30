<?php

namespace Tests\Feature\Front;

use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use App\Models\PageContents\PageContent;
use App\Models\Settings\Settings;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CookieCategoriesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
    }

    /** @test */
    public function it_can_get_cookie_categories_javascript_variables_on_front(): void
    {
        Settings::factory()->withMedia()->create();
        PageContent::factory()->home()->create();
        $cookieCategory = CookieCategory::factory()->create();
        CookieService::factory()->withCategories([$cookieCategory->unique_key])->create(['active' => true]);
        $this->get(route('home.page.show'))
            ->assertOk()
            ->assertSee('"cookie_categories":' . json_encode(CookieCategory::with([
                    'services' => fn(BelongsToMany $services) => $services->where('active', true)->with(['categories']),
                ])->whereHas('services')->ordered()->get(), JSON_THROW_ON_ERROR), false);
    }
}
