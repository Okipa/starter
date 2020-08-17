<?php

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
        // todo: customize settings and seeder image
        /** @var \App\Models\Settings\Settings $settings */
        $settings = (new Settings)->create([
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'instagram' => $this->faker->url,
            'youtube' => $this->faker->url,
        ]);
        $settings->addMedia(database_path('seeds/files/settings/1-300x300.png'))
            ->preservingOriginal()
            ->toMediaCollection('icons');
    }
}
