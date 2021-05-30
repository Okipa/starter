<?php

namespace Database\Factories\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;
use Laravel\Fortify\RecoveryCode;

class UserFactory extends Factory
{
    /** @var string */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->email,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): self
    {
        return $this->state(static fn() => ['email_verified_at' => null]);
    }

    public function twoFactorAuthenticationActivated(): self
    {
        return $this->state(fn() => [
            'two_factor_secret' => encrypt(app(TwoFactorAuthenticationProviderContract::class)->generateSecretKey()),
            'two_factor_recovery_codes' => encrypt(json_encode(Collection::times(8, function () {
                return RecoveryCode::generate();
            })->all(), JSON_THROW_ON_ERROR)),
        ]);
    }

    public function withMedia(string $mediaPath = null): self
    {
        return $this->afterCreating(fn(User $user) => $user->addMedia($mediaPath ?: $this->faker->image(null, 250, 250))
            ->preservingOriginal()
            ->toMediaCollection('profile_pictures'));
    }
}
