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
    }

    /** @test */
    public function it_can_display_user_profile_edit_page(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('profile.edit'))
            ->assertOk()
            ->assertSeeInOrder([
                // Heading
                '<i class="fas fa-user fa-fw"></i>',
                e(__('breadcrumbs.orphan.index', ['entity' => __('Profile')])),
                // Profile form and data
                'method="POST"',
                'action="' . route('user-profile-information.update') . '"',
                'enctype="multipart/form-data"',
                'novalidate>',
                csrf_field(),
                method_field('PUT'),
                $authUser->getFirstMediaUrl('profile_pictures'),
                $authUser->getFirstMediaUrl('profile_pictures', 'thumb'),
                $authUser->last_name,
                $authUser->first_name,
                $authUser->phone_number,
                $authUser->email,
                __('Save'),
                // Password form
                'method="POST"',
                'action="' . route('user-password.update') . '"',
                'novalidate>',
                csrf_field(),
                method_field('PUT'),
                __('Save'),
                // 2FA activation form
                'method="POST"',
                'action="' . route('two-factor.enable') . '"',
                'novalidate>',
                csrf_field(),
                __('Enable'),
                // Account deletion form
                'method="POST"',
                'action="' . route('profile.deleteAccount') . '"',
                'novalidate>',
                csrf_field(),
                __('Delete Account'),
            ], false)
            // User password is not displayed.
            ->assertDontSee([$authUser->password]);
    }

    /** @test */
    public function it_can_display_2fa_recovery_codes_generation_and_deactivation_forms_when_2fa_is_activated(): void
    {
        Settings::factory()->withMedia()->create();
        $authUser = User::factory()->twoFactorAuthenticationActivated()->withMedia()->create();
        $this->actingAs($authUser)->get(route('profile.edit'))->assertSeeInOrder([
            // 2FA recovery codes regeneration form
            'method="POST"',
            'action="' . route('two-factor.recovery-codes') . '"',
            'novalidate>',
            csrf_field(),
            // 2FA deactivation form
            'method="POST"',
            'action="' . route('two-factor.disable') . '"',
            'novalidate>',
            csrf_field(),
            method_field('DELETE'),
        ], false);
    }

    /** @test */
    public function Ait_can_update_user_profile(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('user-profile-information.update'), [
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
            'success',
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['icon']
        );
        self::assertEquals(
            __('Your profile information have been saved.'),
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['title']
        );
        // User data is updated.
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $authUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => $authUser->email,
        ]);
        // Profile picture is updated.
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $authUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'profile-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_set_back_default_profile_picture_when_removed(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('user-profile-information.update'), [
                // Uploaded profile picture is ignored when instruction to remove it is given.
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'remove_profile_picture' => true,
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => $authUser->email,
            ]);
        // Profile picture is updated to default one.
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
        Settings::factory()->create();
        Notification::fake();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('user-profile-information.update'), [
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('profile.edit'));
        // User data is updated.
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
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->put(route('user-password.update'), [
                'current_password' => 'secret',
                'new_password' => 'WP8Z91wd4G28dFC|',
                'new_password_confirmation' => 'WP8Z91wd4G28dFC|',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('alert')
            ->assertRedirect(route('profile.edit'));
        self::assertEquals(
            'success',
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['icon']
        );
        self::assertEquals(
            __('Your new password has been saved.'),
            json_decode(session()->get('alert.config'), true, 512, JSON_THROW_ON_ERROR)['title']
        );
        // Password is updated.
        self::assertTrue(Hash::check('WP8Z91wd4G28dFC|', $authUser->fresh()->password));
    }

    /** @test */
    public function it_can_activate_two_factor_authentication(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->post(route('two-factor.enable'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'two-factor-authentication-enabled')
            ->assertRedirect(route('profile.edit'));
        $authUser->fresh();
        self::assertNotNull($authUser->two_factor_secret);
        self::assertNotNull($authUser->two_factor_recovery_codes);
    }

    public function it_can_regenerate_two_factor_recovery_codes(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->twoFactorAuthenticationActivated()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->post(route('two-factor.recovery-codes'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'recovery-codes-generated')
            ->assertRedirect(route('profile.edit'));
        self::assertNotSame($authUser->two_factor_recovery_codes, $authUser->fresh()->two_factor_recovery_codes);
    }

    /** @test */
    public function it_can_deactivate_two_factor_authentication(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->twoFactorAuthenticationActivated()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->delete(route('two-factor.disable'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'two-factor-authentication-disabled')
            ->assertRedirect(route('profile.edit'));
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $authUser->id,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ]);
    }

    /** @test */
    public function it_can_delete_user_account(): void
    {
        Settings::factory()->create();
        $authUser = User::factory()->create();
        $this->actingAs($authUser)
            ->from(route('profile.edit'))
            ->post(route('profile.deleteAccount'), ['password' => 'secret'])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success', __('Your account has been deleted.'))
            ->assertRedirect(route('home.page.show'));
        // User is deleted.
        $this->assertDeleted(app(User::class)->getTable(), ['id' => $authUser->id]);
    }
}
