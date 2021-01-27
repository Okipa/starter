<?php

namespace Database\Factories\Settings;

use App\Models\Settings\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'youtube' => $this->faker->url,
        ];
    }

    public function withMedia(): self
    {
        return $this->afterCreating(function (Settings $settings) {
            $settings->addMedia(database_path('seeders/files/settings/1-300x300.png'))
                ->preservingOriginal()
                ->toMediaCollection('icons');
        });
    }
}
