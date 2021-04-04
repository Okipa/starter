<?php

namespace Database\Factories\Users;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // Password
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): self
    {
        return $this->state(static fn() => ['email_verified_at' => null]);
    }

    public function withMedia(string $mediaPath = null): self
    {
        return $this->afterCreating(fn(User $user) => $user->addMedia($mediaPath ?: $this->faker->image(null, 250, 250))
            ->preservingOriginal()
            ->toMediaCollection('profile_pictures'));
    }
}
