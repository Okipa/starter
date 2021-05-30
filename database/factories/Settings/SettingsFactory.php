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
            'facebook_url' => $this->faker->unique()->url,
            'twitter_url' => $this->faker->unique()->url,
            'instagram_url' => $this->faker->unique()->url,
            'youtube_url' => $this->faker->unique()->url,
            'google_tag_manager_id' => $this->faker->uuid,
        ];
    }

    public function withMedia(array $media = null): self
    {
        return $this->afterCreating(function (Settings $settings) use ($media) {
            $settings->addMedia(data_get($media, 'logo_squared') ?: $this->faker->image(null, 250, 250))
                ->preservingOriginal()
                ->toMediaCollection('logo_squared');
        });
    }
}
