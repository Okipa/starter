<?php

namespace Tests\Feature\Brickables;

use App\Brickables\Title;
use App\Models\PageContents\PageContent;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Okipa\LaravelBrickables\Models\Brick;
use Tests\TestCase;

class TitleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
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
                e(__('breadcrumbs.parent.create', [
                    'parent' => $pageContent->getReadableClassName(),
                    'entity' => __('Content bricks') . ' > ' . app(Title::class)->getLabel(),
                ])),
                // Form and actions
                'method="POST"',
                'action="' . route('brick.store') . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                'href="' . url('/') . '"',
                __('Back'),
                __('Save'),
            ], false);
    }

    /** @test */
    public function it_can_store_title_brick(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $pageContent = PageContent::factory()->create();
        $data = [
            'model_id' => $pageContent->id,
            'model_type' => $pageContent::class,
            'brickable_type' => Title::class,
            'admin_panel_url' => url('/'),
            'type' => 'h1',
            'style' => 'h1',
        ];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
        }
        $this->actingAs($authUser)
            ->post(route('brick.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.created', [
                'entity' => __('Content bricks'),
                'name' => app(Title::class)->getLabel(),
            ]))
            ->assertRedirect(url('/'));
        // New title brick is created.
        $databaseData = [
            'model_type' => $pageContent::class,
            'model_id' => $pageContent->id,
            'brickable_type' => Title::class,
            'data->type' => 'h1',
            'data->style' => 'h1',
        ];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["data->title->$localeKey"] = $data['title'][$localeKey];
        }
        $this->assertDatabaseHas(app(Brick::class)->getTable(), $databaseData);
    }

    /** @test */
    public function it_can_display_title_brick_edit_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $pageContent = PageContent::factory()->withTitleBrick()->create();
        $editedBrick = $pageContent->getFirstBrick();
        $localizedTitles = [];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $localizedTitles[] = $editedBrick->data['title'][$localeKey];
        }
        $this->actingAs($authUser)->get(route('brick.edit', ['brick' => $editedBrick, 'admin_panel_url' => url('/')]))
            ->assertOk()
            ->assertSeeInOrder(array_merge(
                [
                    // Heading
                    '<i class="fas fa-th-large fa-fw"></i>',
                    e(__('breadcrumbs.parent.edit', [
                        'parent' => $pageContent->getReadableClassName(),
                        'entity' => __('Content bricks'),
                        'detail' => $editedBrick->brickable->getLabel(),
                    ])),
                    // Form and actions
                    'method="POST"',
                    'action="' . route('brick.update', $editedBrick) . '"',
                    'enctype="multipart/form-data"',
                    'novalidate>',
                    csrf_field(),
                    method_field('PUT'),
                    'href="' . url('/') . '"',
                    __('Back'),
                    __('Save'),
                    // Brick data
                ],
                $localizedTitles,
                [
                    'name="type"',
                    '<option value="' . $editedBrick->data['type'] . '" selected="selected">',
                    'name="style"',
                    '<option value="' . $editedBrick->data['style'] . '" selected="selected">',
                ]
            ), false);
    }

    /** @test */
    public function it_can_update_title_brick(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $pageContent = PageContent::factory()->withTitleBrick()->create();
        $editedBrick = $pageContent->getFirstBrick();
        $data = [
            'model_id' => $pageContent->id,
            'model_type' => $pageContent::class,
            'brickable_type' => Title::class,
            'admin_panel_url' => url('/'),
            'type' => 'h2',
            'style' => 'h2',
        ];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['title'][$localeKey] = 'Title test ' . $localeKey;
        }
        $this->actingAs($authUser)
            ->put(route('brick.update', $editedBrick), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Content bricks'),
                'name' => app(Title::class)->getLabel(),
            ]))
            ->assertRedirect(url('/'));
        // Brick data is updated.
        $databaseData = [
            'model_type' => $pageContent::class,
            'model_id' => $pageContent->id,
            'brickable_type' => Title::class,
            'data->type' => 'h2',
            'data->style' => 'h2',
        ];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $databaseData["data->title->$localeKey"] = $data['title'][$localeKey];
        }
        $this->assertDatabaseHas(app(Brick::class)->getTable(), $databaseData);
    }

    /** @test */
    public function it_can_destroy_title_brick(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $pageContent = PageContent::factory()->withTitleBrick()->create();
        $destroyedBrick = $pageContent->getFirstBrick();
        $this->actingAs($authUser)
            ->delete(route('brick.destroy', $destroyedBrick), ['admin_panel_url' => url('/')])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.destroyed', [
                'entity' => __('Content bricks'),
                'name' => app(Title::class)->getLabel(),
            ]))
            ->assertRedirect(url('/'));
        // Brick is deleted.
        $this->assertDeleted(app(Brick::class)->getTable(), ['id' => $destroyedBrick->id]);
    }

    /** @test */
    public function it_can_display_title_brick(): void
    {
        Settings::factory()->withMedia()->create();
        $pageContent = PageContent::factory()->home()->withTitleBrick()->create();
        $titleBrick = $pageContent->getFirstBrick();
        $this->get(route('home.page.show'))->assertOk()->assertSee([
            // ToDo: replace `translatedData` by `data_get` if your app is not multilingual.
            '<h1 class="h1 text-primary m-0">' . translatedData($titleBrick, 'data.title') . '</h1>',
        ], false);
    }
}
