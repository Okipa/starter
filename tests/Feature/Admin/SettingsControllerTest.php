<?php

namespace Tests\Feature\Admin;

use App\Http\Middleware\ShareJavascriptToView;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Closure;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class, ShareJavascriptToView::class]);
    }

    /** @test */
    public function it_can_display_settings_edit_page(): void
    {
        $settings = Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)
            ->get(route('settings.edit'))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-cogs fa-fw"></i>',
                e(__('breadcrumbs.orphan.index', ['entity' => __('Settings')])),
                // Form
                'method="POST"',
                'action="' . route('settings.update') . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                method_field('PUT'),
                __('Update'),
                // Settings data
                $settings->getFirstMediaUrl('logo_squared', 'thumb'),
                $settings->getFirstMedia('logo_squared')->file_name,
                $settings->email,
                $settings->phone_number,
                $settings->address,
                $settings->zip_code,
                $settings->city,
                $settings->facebook_url,
                $settings->twitter_url,
                $settings->instagram_url,
                $settings->youtube_url,
                $settings->matomo_url,
                $settings->matomo_id_site,
            ], false);
    }

    /** @test */
    public function it_can_update_settings(): void
    {
        $settings = Settings::factory()->create();
        $authUser = User::factory()->create();
        // Cache is cleared and regenerated after update.
        Cache::shouldReceive('forget')->once()->with('settings')->andReturn(true);
        Cache::shouldReceive('rememberForever')->once()->with('settings', Closure::class)->andReturn($settings);
        $this->actingAs($authUser)
            ->from(route('settings.edit'))
            ->put(route('settings.update'), [
                'logo_squared' => UploadedFile::fake()->image('logo-squared.webp', 225, 225),
                'email' => 'test@email.fr',
                'phone_number' => '0202020202',
                'address' => 'Address test',
                'zip_code' => 'Zip code test',
                'city' => 'City test',
                'facebook_url' => 'https://www.facebook.com',
                'twitter_url' => 'https://twitter.com',
                'instagram_url' => 'https://www.instagram.com',
                'youtube_url' => 'https://www.youtube.com',
                'matomo_url' => 'https://www.matomo.org',
                'matomo_id_site' => 'Matomo ID site test',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.name.updated', ['name' => __('Settings')]))
            ->assertRedirect(route('settings.edit'));
        // Settings data is updated.
        $this->assertDatabaseHas(app(Settings::class)->getTable(), [
            'email' => 'test@email.fr',
            'phone_number' => '0202020202',
            'address' => 'Address test',
            'zip_code' => 'Zip code test',
            'city' => 'City test',
            'facebook_url' => 'https://www.facebook.com',
            'twitter_url' => 'https://twitter.com',
            'instagram_url' => 'https://www.instagram.com',
            'youtube_url' => 'https://www.youtube.com',
            'matomo_url' => 'https://www.matomo.org',
            'matomo_id_site' => 'Matomo ID site test',
        ]);
        // Settings logo is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $settings->id,
            'model_type' => Settings::class,
            'collection_name' => 'logo_squared',
            'file_name' => 'logo-squared.webp',
        ]);
    }
}
