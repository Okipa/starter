<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    protected \Faker\Generator $faker;

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function run(): void
    {
        $this->faker = Factory::create(config('app.faker_locale'));
        // todo: to customize
        $settings = Settings::create([
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'youtube' => $this->faker->url,
        ]);
        $settings->addMedia(database_path('seeders/files/settings/1-300x300.png'))
            ->preservingOriginal()
            ->toMediaCollection('icons');
    }
}
