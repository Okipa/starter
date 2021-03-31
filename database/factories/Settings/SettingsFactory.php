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

    public function withMedia(array $media = []): Factory
    {
        return $this->afterCreating(function (Settings $settings) use ($media) {
            $settings->addMedia(data_get($media, 'logo_rounded') ?: $this->faker->image(null, 250, 250))
                ->preservingOriginal()
                ->toMediaCollection('logo_rounded');
        });
    }
}
