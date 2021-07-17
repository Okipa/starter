<?php

namespace Tests\Feature\Admin;

use App\Models\Settings\Settings;
use App\Models\Users\User;
use App\Notifications\InitializePassword;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class]);
    }

    /** @test */
    public function it_can_display_users_list(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        Carbon::setTestNow(now()->addMinute());
        $user2 = User::factory()->withMedia()->create();
        $this->actingAs($authUser)
            ->get(route('users.index'))
            ->assertOk()
            ->assertSeeInOrder([
                // Users data is displayed in table columns.
                $user2->id,
                $user2->getFirstMediaUrl('profile_pictures', 'thumb'),
                Str::limit($user2->first_name, 25),
                Str::limit($user2->last_name, 25),
                Str::limit($user2->email, 25),
                $user2->created_at->format('d/m/Y H:i'),
                $user2->updated_at->format('d/m/Y H:i'),
                route('user.edit', $user2),
                route('user.destroy', $user2),
                'data-confirm',
                __('crud.orphan.destroy_confirm', ['entity' => __('Users'), 'name' => $user2->full_name]),
                $authUser->id,
                $authUser->getFirstMediaUrl('profile_pictures', 'thumb'),
                Str::limit($authUser->first_name, 25),
                Str::limit($authUser->last_name, 25),
                Str::limit($authUser->email, 25),
                $authUser->created_at->format('d/m/Y H:i'),
                $authUser->updated_at->format('d/m/Y H:i'),
            ], false)
            ->assertDontSee([
                // Auth user can't edit or delete himself from table.
                route('user.edit', $authUser),
                route('user.destroy', $authUser),
                __('crud.orphan.destroy_confirm', ['entity' => __('Users'), 'name' => $authUser->full_name]),
            ], false);
    }

    /** @test */
    public function it_can_display_user_create_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('user.create'))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-user fa-fw"></i>',
                e(__('breadcrumbs.orphan.create', ['entity' => __('Users')])),
                // Form and actions
                'method="POST"',
                'action="' . route('user.store') . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                'href="' . route('users.index') . '"',
                __('Back'),
                __('Save'),
            ], false);
    }

    /** @test */
    public function it_can_store_user(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->post(route('user.store'), [
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
                'password' => 'WP8Z91wd4G28dFC|',
                'password_confirmation' => 'WP8Z91wd4G28dFC|',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.created', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('users.index'));
        $createdUser = User::latest('id')->first();
        // New user is created.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $createdUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
        ]);
        // New password is correct.
        self::assertTrue(Hash::check('WP8Z91wd4G28dFC|', $createdUser->fresh()->password));
        // New profile picture is attached.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $createdUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'profile-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_store_user_without_password_and_send_invitation_email_to_create_it(): void
    {
        Settings::factory()->create();
        Notification::fake();
        $authUser = User::factory()->create();
        $now = now();
        Carbon::setTestNow($now);
        $this->actingAs($authUser)
            ->post(route('user.store'), [
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.created', [
                    'entity' => __('Users'),
                    'name' => 'First name test Last name test',
                ]) . ' ' . __('A password creation link has been sent.'))
            ->assertRedirect(route('users.index'));
        $createdUser = User::latest('id')->first();
        // Notification is sent.
        Notification::assertSentTo($createdUser, InitializePassword::class, static fn(
            InitializePassword $notification,
            array $channels,
            User $notifiable
        ) => $notification->toMail($createdUser) // Manual execution of the `toMail` method.
            && $notification->locale === config('app.locale')
            && $notification->queue === 'high'
            && $notification->user->is($createdUser)
            && $notification->showWelcomeFormUrl === URL::signedRoute(
                'password.welcome',
                ['user' => $createdUser->id],
                $now->copy()->addMinutes(120)
            )
            && $notification->validUntil->equalTo($now->copy()->addMinutes(120))
            && $channels === ['mail']
            && $notifiable->is($createdUser));
        Notification::assertTimesSent(1, InitializePassword::class);
        // New user is created.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $createdUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
            'welcome_valid_until' => $now->addMinutes(120)->toDateTimeString(),
        ]);
    }

    /** @test */
    public function it_can_display_user_edit_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $editedUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('user.edit', $editedUser))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-user fa-fw"></i>',
                e(__('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $editedUser->full_name])),
                // Form and actions
                'method="POST"',
                'action="' . route('user.update', $editedUser) . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                method_field('PUT'),
                'href="' . route('users.index') . '"',
                __('Back'),
                __('Save'),
                // User data
                $editedUser->getFirstMediaUrl('profile_pictures'),
                $editedUser->getFirstMediaUrl('profile_pictures', 'thumb'),
                $editedUser->last_name,
                $editedUser->first_name,
                $editedUser->phone_number,
                $editedUser->email,
            ], false)
            // User password is not displayed.
            ->assertDontSee([$editedUser->password]);
    }

    /** @test */
    public function it_can_update_user(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $updatedUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('user.edit', $updatedUser))
            ->put(route('user.update', $updatedUser), [
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
                'new_password' => 'WP8Z91wd4G28dFC|',
                'new_password_confirmation' => 'WP8Z91wd4G28dFC|',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('user.edit', $updatedUser));
        // User data is updated.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $updatedUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
        ]);
        // Password is updated.
        self::assertTrue(Hash::check('WP8Z91wd4G28dFC|', $updatedUser->fresh()->password));
        // Profile picture is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $updatedUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'profile-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_set_back_default_profile_picture_when_removing_it(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $updatedUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('user.edit', $updatedUser))
            ->put(route('user.update', $updatedUser), [
                // Uploaded profile picture is ignored when user want to remove it.
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'remove_profile_picture' => true,
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('user.edit', $updatedUser));
        // Profile picture is updated to default one.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $updatedUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'anonymous-user.png',
        ]);
    }

    /** @test */
    public function it_can_delete_user(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->withMedia()->create();
        $destroyedUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('users.index'))
            ->delete(route('user.destroy', $destroyedUser))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.destroyed', [
                'entity' => __('Users'),
                'name' => $destroyedUser->full_name,
            ]))
            ->assertRedirect(route('users.index'));
        // User is deleted.
        $this->assertDeleted(app(User::class)->getTable(), ['id' => $destroyedUser->id]);
    }
}
