<?php

namespace Tests\Feature\Admin;

use App\Models\Settings\Settings;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMix();
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
                $user2->first_name,
                $user2->last_name,
                $user2->email,
                $user2->created_at->format('d/m/Y H:i'),
                $user2->updated_at->format('d/m/Y H:i'),
                $user1->id,
                $user1->getFirstMediaUrl('profile_pictures', 'thumb'),
                $user1->first_name,
                $user1->last_name,
                $user1->email,
                $user1->created_at->format('d/m/Y H:i'),
                $user1->updated_at->format('d/m/Y H:i'),
            ], false);
    }

    /** @test */
    public function it_can_display_user_create_page(): void
    {
        $user = User::factory()->withMedia()->create();
        $this->actingAs($user)->get(route('user.create'))->assertOk()->assertSeeInOrder([
            '<i class="fas fa-user fa-fw"></i>',
            __('breadcrumbs.orphan.create', ['entity' => __('Users')]),
            route('user.store'),
        ], false);
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
                'email' => 'contact@acid.fr',
                'password' => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('toast_success', __('crud.orphan.created', [
                'entity' => __('Users'),
                'name' => 'First name test Last name test',
            ]))
            ->assertRedirect(route('users.index'));
        $this->assertDatabaseHas(app(User::class)->getTable(), [
            'first_name' => 'First name test',
            'last_name' => 'Last name test',
            'phone_number' => '0240506070',
            'email' => 'contact@acid.fr',
        ]);
    }

    /** @test */
    public function it_can_display_user_edit_page(): void
    {
        $user = User::factory()->withMedia()->create();
        $this->actingAs($user)->get(route('user.edit', $user))->assertOk()->assertSeeInOrder([
            '<i class="fas fa-user fa-fw"></i>',
            __('breadcrumbs.orphan.edit', ['entity' => __('Users'), 'detail' => $user->full_name]),
            route('user.update', $user),
        ], false);
    }
}
