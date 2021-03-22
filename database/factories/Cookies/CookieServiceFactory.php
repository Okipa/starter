<?php

namespace Database\Factories;

use App\Models\Cookies\CookieService;
use Illuminate\Database\Eloquent\Factories\Factory;

class CookieServiceFactory extends Factory
{
    /** @var string */
    protected $model = CookieService::class;

    public function definition(): array
    {
        return [
            'title' => ['fr' => $this->faker->catchPhrase, 'en' => $this->faker->catchPhrase],
        ];
    }
}
