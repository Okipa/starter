<?php

namespace Tests\Feature\Admin;

use App\Models\PageContents\PageContent;
use App\Models\Settings\Settings;
use App\Models\Users\User;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Plank\Metable\Meta;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class ContactPageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class]);
    }

    /** @test */
    public function it_can_display_contact_page_edit_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $contactPage = PageContent::factory()->contact()->withSeoMeta(image: 'dummy')->create();
        // ToDo: convert in monolingual if your app is not multilingual.
        // Translated SEO data
        $seoData = [];
        foreach (supportedLocaleKeys() as $localeKey) {
            $seoData[] = $contactPage->getMeta('meta_title', null, $localeKey);
        }
        foreach (supportedLocaleKeys() as $localeKey) {
            $seoData[] = $contactPage->getMeta('meta_description', null, $localeKey);
        }
        $this->actingAs($authUser)->get(route('contact.page.edit'))->assertOk()->assertSeeInOrder(array_merge([
            // Heading
            '<i class="fas fa-desktop fa-fw"></i>',
            e(__('breadcrumbs.orphan.edit', ['entity' => __('Contact'), 'detail' => __('Page')])),
            // Form and actions
            'method="POST"',
            'action="' . route('contact.page.update') . '"',
            'enctype="multipart/form-data"',
            'novalidate>',
            csrf_field(),
            method_field('PUT'),
            __('Save'),
            'href="' . route('contact.page.show') . '"',
            __('Display'),
            // Non-translated SEO data
            $contactPage->getFirstMediaUrl('seo'),
            $contactPage->getFirstMediaUrl('seo', 'thumb'),
        ], $seoData), false);
    }

    /** @test */
    public function it_can_update_contact_page(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $contactPage = PageContent::factory()->contact()->create();
        $data = ['meta_image' => UploadedFile::fake()->image('meta-image.webp', 600, 600)];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['meta_title'][$localeKey] = 'Meta title test ' . $localeKey;
            $data['meta_description'][$localeKey] = 'Meta title test ' . $localeKey;
        }
        $this->actingAs($authUser)
            ->from(route('contact.page.edit'))
            ->put(route('contact.page.update'), $data)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Contact'),
                'name' => __('Page'),
            ]))
            ->assertRedirect(route('contact.page.edit'));
        // Meta data is updated.
        $this->assertDatabaseHas(app(Meta::class)->getTable(), [
            'metable_id' => $contactPage->id,
            'metable_type' => PageContent::class,
            'type' => 'array',
            'key' => 'meta_title',
            'value' => json_encode($data['meta_title'], JSON_THROW_ON_ERROR),
        ]);
        $this->assertDatabaseHas(app(Meta::class)->getTable(), [
            'metable_id' => $contactPage->id,
            'metable_type' => PageContent::class,
            'type' => 'array',
            'key' => 'meta_description',
            'value' => json_encode($data['meta_description'], JSON_THROW_ON_ERROR),
        ]);
        // Meta image is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $contactPage->id,
            'model_type' => PageContent::class,
            'collection_name' => 'seo',
            'file_name' => 'meta-image.webp',
        ]);
    }

    /** @test */
    public function it_can_remove_seo_image(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $contactPage = PageContent::factory()->contact()->create();
        $data = [
            // Uploaded meta image is ignored when instruction to remove it is given.
            'meta_image' => UploadedFile::fake()->image('meta-image.webp', 600, 600),
            'remove_meta_image' => true,
        ];
        // ToDo: convert in monolingual if your app is not multilingual.
        foreach (supportedLocaleKeys() as $localeKey) {
            $data['meta_title'][$localeKey] = 'Meta title test ' . $localeKey;
        }
        $this->actingAs($authUser)
            ->from(route('contact.page.edit'))
            ->put(route('contact.page.update'), $data);
        // Meta image is deleted.
        $this->assertDeleted(app(Media::class)->getTable(), [
            'model_id' => $contactPage->id,
            'model_type' => PageContent::class,
            'collection_name' => 'seo',
            'file_name' => 'meta-image.webp',
        ]);
    }
}
