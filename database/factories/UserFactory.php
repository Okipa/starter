<?php

namespace Database\Factories;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /** @var string */
    protected $model = User::class;

    protected array $images = [
        '1-512x512.jpg', '2-512x512.jpg', '3-512x512.jpg', '4-512x512.jpg', '5-512x512.jpg', '6-512x512.jpg',
        '7-512x512.jpg', '8-512x512.jpg', '9-512x512.jpg', '10-512x512.jpg',
    ];

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (User $user) {
            $imagePath = $this->images[array_rand($this->images, 1)];
            $user->addMedia(database_path('seeders/files/users/' . $imagePath))
                ->preservingOriginal()
                ->toMediaCollection('profile_pictures');
        });
    }
}
