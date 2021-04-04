<?php

namespace Tests\Feature\Admin;

use App\Models\Settings\Settings;
use App\Models\Users\User;
use App\Notifications\VerifyEmail;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
        $this->withoutMiddleware([RequirePassword::class]);
        Settings::factory()->withMedia()->create();
    }

    /** @test */
    public function it_can_display_user_profile_edit_page(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('profile.edit'))
            ->assertOk()
            ->assertSeeInOrder([
                // Headings and form actions should confirm we are on profile edit page.
                'fas fa-user fa-fw',
                __('Profile'),
                route('profile.update'),
                // User data should be displayed.
                $authUser->getFirstMediaUrl('profile_pictures', 'thumb'),
                $authUser->getFirstMedia('profile_pictures')->file_name,
                $authUser->last_name,
                $authUser->first_name,
                $authUser->phone_number,
                $authUser->email,
                // Other form actions should be present.
                route('password.update'),
                route('two-factor.activate'),
                route('profile.deleteAccount'),
            ])
            ->assertDontSee([$authUser->password]);
    }

    /** @test */
    public function it_can_update_user_profile(): void
    {
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('profile.update'), [
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => $authUser->email,
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('alert')
            ->assertRedirect(route('profile.edit'));
        self::assertEquals(
            __('Your profile information have been saved.'),
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['title']
        );
        // User data should have been updated.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $authUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => $authUser->email,
        ]);
        // Profile picture should have been updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $authUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'profile-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_set_back_default_profile_picture_when_user_remove_it(): void
    {
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('profile.update'), [
                // Uploaded profile picture should be ignored when user want to remove it.
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'remove_profile_picture' => true,
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => $authUser->email,
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('alert')
            ->assertRedirect(route('profile.edit'));
        // Profile picture should have been updated to default one.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $authUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'anonymous-user.png',
        ]);
    }

    /** @test */
    public function it_can_pass_user_account_to_unverified_email_status_when_updating_email_address(): void
    {
        Notification::fake();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('profile.update'), [
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('profile.edit'));
        // User data should have been updated.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $authUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
            'email_verified_at' => null,
        ]);
        Notification::assertSentTo($authUser, VerifyEmail::class, static fn(
            VerifyEmail $notification,
            array $channels,
            User $notifiable
        ) => $notification->locale === config('app.locale')
            && $notification->queue === 'high'
            && $channels === ['mail']
            && $notifiable->is($authUser));
        Notification::assertTimesSent(1, VerifyEmail::class);
    }

    /** @test */
    public function it_can_update_user_password(): void
    {
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('password.update'), [
                'current_password' => 'secret',
                'new_password' => 'password',
                'new_password_confirmation' => 'password',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('alert')
            ->assertRedirect(route('profile.edit'));
        self::assertEquals(
            __('Your new password has been saved.'),
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['title']
        );
        self::assertTrue(Hash::check('password', $authUser->fresh()->password));
    }

    /** @test */
    public function it_can_delete_user_account(): void
    {
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->post(route('profile.deleteAccount'), ['password' => 'secret'])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', __('Your account has been deleted.'))
            ->assertRedirect(route('home.page.show'));
        $this->assertDeleted(app(User::class)->getTable(), ['id' => $authUser->id]);
    }
}
