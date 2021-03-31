<?php

namespace Tests\Feature\Admin;

use App\Models\Settings\Settings;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
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
        Settings::factory()->create();
    }

    /** @test */
    public function it_can_display_users_list(): void
    {
        $user1 = User::factory()->withMedia()->create();
        Carbon::setTestNow(now()->addMinute());
        $user2 = User::factory()->withMedia()->create();
        $this->actingAs($user1)
            ->get(route('users.index'))
            ->assertOk()
            ->assertSeeInOrder([
                $user2->id,
                $user2->getFirstMediaUrl('profile_pictures', 'thumb'),
                Str::limit($user2->first_name, 25),
                Str::limit($user2->last_name, 25),
                Str::limit($user2->email, 25),
                $user2->created_at->format('d/m/Y H:i'),
                $user2->updated_at->format('d/m/Y H:i'),
                $user1->id,
                $user1->getFirstMediaUrl('profile_pictures', 'thumb'),
                Str::limit($user1->first_name, 25),
                Str::limit($user1->last_name, 25),
                Str::limit($user1->email, 25),
                $user1->created_at->format('d/m/Y H:i'),
                $user1->updated_at->format('d/m/Y H:i'),
            ]);
    }

    /** @test */
    public function it_can_display_user_create_page(): void
    {
        $user = User::factory()->withMedia()->create();
        $this->actingAs($user)->get(route('user.create'))
            ->assertOk()
            ->assertSeeInOrder([
                'fas fa-user fa-fw',
                __('breadcrumbs.orphan.create', ['entity' => __('Users')]),
                route('user.store'),
            ]);
    }

    /** @test */
    public function it_can_store_user(): void
    {
        $user = User::factory()->withMedia()->create();
        $this->actingAs($user)
            ->post(route('user.store'), [
                'profile_picture' => UploadedFile::fake()->image('profile-picture.webp', 250, 250),
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.created', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('users.index'));
        $createdUser = User::latest('id');
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $createdUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
        ]);
        self::assertTrue(Hash::check('password', $createdUser->fresh()->password));
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $createdUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'profile-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_display_user_edit_page(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $editedUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)->get(route('user.edit', $editedUser))
            ->assertOk()
            ->assertSeeInOrder([
                'fas fa-user fa-fw',
                __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $editedUser->full_name]),
                route('user.update', $editedUser),
                $editedUser->getFirstMediaUrl('profile_pictures', 'thumb'),
                $editedUser->getFirstMedia('profile_pictures')->file_name,
                $editedUser->last_name,
                $editedUser->first_name,
                $editedUser->phone_number,
                $editedUser->email,
            ])
            ->assertDontSee([$editedUser->password]);
    }

    /** @test */
    public function it_can_update_user(): void
    {
        $authUser = User::factory()->withMedia()->create();
        $updatedUser = User::factory()->withMedia()->create();
        $this->actingAs($authUser)
            ->put(route('user.update', $updatedUser), [
                'remove__profile_picture' => true,
                'first_name' => 'First name test',
                'last_name' => 'Last name test',
                'phone_number' => '0240506070',
                'email' => 'test@email.fr',
                'new_password' => 'password',
                'new_password_confirmation' => 'password',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.updated', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('user.edit', $updatedUser));
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'id' => $updatedUser->id,
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'test@email.fr',
        ]);
        self::assertTrue(Hash::check('password', $updatedUser->fresh()->password));
        $this->assertDatabaseHas(app(Media::class)->getTable(), [
            'model_id' => $updatedUser->id,
            'model_type' => User::class,
            'collection_name' => 'profile_pictures',
            'file_name' => 'anonymouse-picture.webp',
        ]);
    }

    /** @test */
    public function it_can_delete_user(): void
    {
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
        $this->assertDatabaseMissing(app(User::class)->getTable(), ['id' => $destroyedUser->id]);
    }
}
