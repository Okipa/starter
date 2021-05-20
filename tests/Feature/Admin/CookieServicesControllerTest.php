<?php

namespace Tests\Feature\Admin;

use App\Http\Middleware\ShareJavascriptToView;
use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

class CookieServicesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class, ShareJavascriptToView::class]);
    }

    /** @test */
    public function it_can_display_cookie_services_list(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory1 = CookieCategory::factory()->create();
        $cookieCategory2 = CookieCategory::factory()->create();
        $cookieService1 = CookieService::factory()
            ->withCategories([$cookieCategory1->unique_key])
            ->create(['active' => true]);
        // 1 minute later.
        Carbon::setTestNow(now()->addMinute());
        $cookieService2 = CookieService::factory()
            ->withCategories([$cookieCategory1->unique_key, $cookieCategory2->unique_key])
            ->create(['active' => false]);
        $this->actingAs($authUser)
            ->get(route('cookie.services.index'))
            ->assertOk()
            ->assertSeeInOrder([
                // Cookie services data is displayed in table columns.
                $cookieService2->id,
                $cookieService2->unique_key,
                e(Str::limit($cookieService2->title, 25)),
                e(Str::limit($cookieCategory1->title, 25) . ', ' . Str::limit($cookieCategory2->title, 25)),
                view('components.admin.table.bool', ['bool' => false])->toHtml(),
                $cookieService2->created_at->format('d/m/Y H:i'),
                $cookieService2->updated_at->format('d/m/Y H:i'),
                $cookieService1->id,
                $cookieService1->unique_key,
                e(Str::limit($cookieService1->title, 25)),
                e(Str::limit($cookieCategory1->title, 25)),
                view('components.admin.table.bool', ['bool' => true])->toHtml(),
                $cookieService1->created_at->format('d/m/Y H:i'),
                $cookieService1->updated_at->format('d/m/Y H:i'),
            ], false);
    }

    /** @test */
    public function it_can_filter_cookie_services_list_by_category(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory1 = CookieCategory::factory()->create();
        $cookieCategory2 = CookieCategory::factory()->create();
        $cookieService1 = CookieService::factory()
            ->withCategories([$cookieCategory1->unique_key])
            ->create(['active' => true]);
        // 1 minute later.
        Carbon::setTestNow(now()->addMinute());
        $cookieService2 = CookieService::factory()
            ->withCategories([$cookieCategory1->unique_key, $cookieCategory2->unique_key])
            ->create(['active' => false]);
        $this->actingAs($authUser)
            ->get(route('cookie.services.index', ['category_id' => $cookieCategory2->id]))
            ->assertOk()
            ->assertSeeInOrder([
                // Filtered cookie services data is displayed in table columns.
                $cookieService2->id,
                $cookieService2->unique_key,
                e(Str::limit($cookieService2->title, 25)),
                e(Str::limit($cookieCategory1->title, 25) . ', ' . Str::limit($cookieCategory2->title, 25)),
                view('components.admin.table.bool', ['bool' => false])->toHtml(),
                $cookieService2->created_at->format('d/m/Y H:i'),
                $cookieService2->updated_at->format('d/m/Y H:i'),
            ], false)
            ->assertDontSee([
                // Other cookie services data is not displayed in table columns.
                $cookieService1->unique_key,
                e(Str::limit($cookieService1->title, 25)),
                view('components.admin.table.bool', ['bool' => true])->toHtml(),
                $cookieService1->created_at->format('d/m/Y H:i'),
                $cookieService1->updated_at->format('d/m/Y H:i'),
            ], false);
    }

    /** @test */
    public function it_can_display_cookie_service_create_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('cookie.service.create'))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-laptop-code fa-fw"></i>',
                e(__('breadcrumbs.parent.create', [
                    'parent' => __('Cookies'),
                    'entity' => __('Services'),
                ])),
                // Form and actions
                'method="POST"',
                'action="' . route('cookie.service.store') . '"',
                'novalidate>',
                csrf_field(),
                'href="' . route('cookie.services.index') . '"',
                __('Back'),
                __('Create'),
            ], false);
    }

    /** @test */
    public function it_can_store_cookie_service(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $data = [
            'category_ids' => [$cookieCategory->id],
            'unique_key' => 'unique_key_test',
            'cookies' => json_encode(['cookie_test'], JSON_THROW_ON_ERROR),
            'required' => true,
            'enabled_by_default' => true,
            'active' => true,
        ];
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
            $data['description'][$localeKey] = 'Description test ' . $localeKey;
        }
        // Cache is cleared and regenerated after creation.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect());
        $this->actingAs($authUser)
            ->post(route('cookie.service.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.created', [
                'parent' => __('Cookies'),
                'entity' => __('Services'),
                'name' => $data['title'][app()->getLocale()],
            ]))
            ->assertRedirect(route('cookie.services.index'));
        $cookieService = CookieService::first();
        // New cookie service is created.
        $databaseData = [
            'id' => $cookieService->id,
            'unique_key' => 'unique_key_test',
            'required' => true,
            'enabled_by_default' => true,
            'active' => true,
        ];
        self::assertSame($cookieService->cookies, ['cookie_test']);
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["title->$localeKey"] = $data['title'][$localeKey];
            $databaseData["description->$localeKey"] = $data['description'][$localeKey];
        }
        $this->assertDatabaseHas(app(CookieService::class)->getTable(), $databaseData);
        $this->assertDatabaseHas('cookie_service_category', [
            'cookie_service_id' => $cookieService->id,
            'Cookie_category_id' => $cookieCategory->id,
        ]);
    }

    /** @test */
    public function it_can_display_cookie_service_edit_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $cookieService = CookieService::factory()->withCategories([$cookieCategory->unique_key])->create([
            'required' => true,
            'enabled_by_default' => true,
            'active' => true,
        ]);
        $localizedTitles = [];
        $localizedDescriptions = [];
        foreach (supportedLocaleKeys() as $localeKey) {
            $localizedTitles[] = e($cookieService->getTranslation('title', $localeKey));
            $localizedDescriptions[] = e($cookieService->getTranslation('description', $localeKey));
        }
        $this->actingAs($authUser)->get(route('cookie.service.edit', $cookieService))
            ->assertOk()
            ->assertSeeInOrder(array_merge(
                [
                    // Heading
                    '<i class="fas fa-laptop-code fa-fw"></i>',
                    e(__('breadcrumbs.parent.edit', [
                        'parent' => __('Cookies'),
                        'entity' => __('Services'),
                        'detail' => $cookieService->title,
                    ])),
                    // Form and actions
                    'method="POST"',
                    'action="' . route('cookie.service.update', $cookieService) . '"',
                    'novalidate>',
                    csrf_field(),
                    method_field('PUT'),
                    'href="' . route('cookie.services.index') . '"',
                    __('Back'),
                    __('Update'),
                    // Cookie service data
                    '<option value="' . $cookieCategory->id . '" selected="selected">',
                    $cookieService->unique_key,
                ],
                $localizedTitles,
                $localizedDescriptions,
                [
                    'name="required" checked="checked"',
                    'name="enabled_by_default" checked="checked"',
                    e(json_encode($cookieService->cookies, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR)),
                    'name="active" checked="checked"',
                ]
            ), false);
    }

    /** @test */
    public function it_can_update_cookie_service(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $cookieService = CookieService::factory()->create([
            'required' => false,
            'enabled_by_default' => false,
            'active' => false,
        ]);
        $data = [
            'category_ids' => [$cookieCategory->id],
            'unique_key' => 'unique_key_test',
            'cookies' => json_encode(['cookie_test'], JSON_THROW_ON_ERROR),
            'required' => true,
            'enabled_by_default' => true,
            'active' => true,
        ];
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
            $data['description'][$localeKey] = 'Description test ' . $localeKey;
        }
        // Cache is cleared and regenerated after creation.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect());
        $this->actingAs($authUser)
            ->from(route('cookie.service.edit', $cookieService))
            ->put(route('cookie.service.update', $cookieService), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.updated', [
                'parent' => __('Cookies'),
                'entity' => __('Services'),
                'name' => $data['title'][app()->getLocale()],
            ]))
            ->assertRedirect(route('cookie.service.edit', $cookieService));
        // New cookie service is created.
        $databaseData = [
            'id' => $cookieService->id,
            'unique_key' => 'unique_key_test',
            'required' => true,
            'enabled_by_default' => true,
            'active' => true,
        ];
        self::assertSame($cookieService->fresh()->cookies, ['cookie_test']);
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["title->$localeKey"] = $data['title'][$localeKey];
            $databaseData["description->$localeKey"] = $data['description'][$localeKey];
        }
        $this->assertDatabaseHas(app(CookieService::class)->getTable(), $databaseData);
        $this->assertDatabaseHas('cookie_service_category', [
            'cookie_service_id' => $cookieService->id,
            'Cookie_category_id' => $cookieCategory->id,
        ]);
    }

    /** @test */
    public function it_can_delete_cookie_service(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->withMedia()->create();
        $cookieCategory = CookieCategory::factory()->create();
        $cookieService = CookieService::factory()->withCategories([$cookieCategory->unique_key])->create();
        // Cache is cleared and regenerated after deletion.
        Cache::shouldReceive('forget')->once()->with('cookie_categories')->andReturn(true);
        Cache::shouldReceive('rememberForever')
            ->once()
            ->with('cookie_categories', Closure::class)
            ->andReturn(collect());
        $this->actingAs($authUser)
            ->from(route('cookie.services.index'))
            ->delete(route('cookie.service.destroy', $cookieService))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.parent.destroyed', [
                'parent' => __('Cookies'),
                'entity' => __('Services'),
                'name' => $cookieService->title,
            ]))
            ->assertRedirect(route('cookie.services.index'));
        // Cookie service is deleted.
        $this->assertDeleted(app(CookieService::class)->getTable(), ['id' => $cookieService->id]);
        // Cookie category/service relation is deleted.
        $this->assertDeleted('cookie_service_category', [
            'cookie_service_id' => $cookieService->id,
            'Cookie_category_id' => $cookieCategory->id,
        ]);
    }
}
