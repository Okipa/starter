<?php

use App\Models\Users\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$images = [
    '1-512x512.jpg', '2-512x512.jpg', '3-512x512.jpg', '4-512x512.jpg', '5-512x512.jpg', '6-512x512.jpg',
    '7-512x512.jpg', '8-512x512.jpg', '9-512x512.jpg', '10-512x512.jpg',
];

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->afterCreating(User::class, function (User $user, Faker $faker) use ($images) {
    $imagePath = $images[array_rand($images, 1)];
    $user->addMedia(database_path('seeds/files/users/' . $imagePath))
        ->preservingOriginal()
        ->toMediaCollection('profile_pictures');
});
