<?php

namespace Tests\Feature\Admin;

use App\Brickables\Title;
use App\Models\PageContents\PageContent;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrickableTitleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_can_display_title_brick_create_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $pageContent = PageContent::factory()->create();
        $this->actingAs($authUser)
            ->get(route('brick.create', [
                'model_id' => $pageContent->id,
                'model_type' => $pageContent::class,
                'brickable_type' => Title::class,
                'admin_panel_url' => url('/'),
            ]))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-th-large fa-fw"></i>',
                __('Page content') . ' > ' . __('Content bricks') . ' > ' . __('Title') . ' > ' . __('Creation'),
                // Form and actions
                'method="POST"',
                'action="' . route('brick.store') . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                'href="' . url('/') . '"',
                __('Back'),
                __('Create'),
            ], false);
    }

    public function it_can_store_title_brick(): void
    {

    }

    public function it_can_display_title_brick_edit_page(): void
    {
    }

    public function it_can_update_title_brick(): void
    {
    }

    public function it_can_destroy_title_brick(): void
    {
    }
}
