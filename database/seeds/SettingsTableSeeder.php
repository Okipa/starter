<?php

use App\Models\Settings;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    protected $faker;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->faker = Factory::create(config('app.faker_locale'));
        // todo : customize settings and seeder image
        /** @var \App\Models\Settings $settings */
        $settings = (new Settings)->create([
            'email'        => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'address'      => $this->faker->address,
            'zip_code'     => $this->faker->postcode,
            'city'         => $this->faker->city,
            'facebook'     => $this->faker->url,
            'twitter'      => $this->faker->url,
            'instagram'    => $this->faker->url,
            'youtube'      => $this->faker->url,
        ]);
        $settings->addMedia(database_path('seeds/files/settings/icon-300-300.png'))
            ->preservingOriginal()
            ->toMediaCollection('icon');
    }
}
