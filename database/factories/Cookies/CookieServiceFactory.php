<?php

namespace Database\Factories\Cookies;

use App\Models\Cookies\CookieCategory;
use App\Models\Cookies\CookieService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CookieServiceFactory extends Factory
{
    /** @var string */
    protected $model = CookieService::class;

    public function definition(): array
    {
        $titles = ['fr' => $this->faker->catchPhrase, 'en' => $this->faker->catchPhrase];

        return [
            'unique_key' => Str::slug($titles['en']),
            'title' => $titles,
            'description' => ['fr' => $this->faker->realText(), 'en' => $this->faker->realText()],
            'cookies' => [['/^_cookie.*$/']],
            'required' => $this->faker->boolean,
            'enabled_by_default' => $this->faker->boolean,
            'active' => $this->faker->boolean,
        ];
    }

    public function withCategories(?array $categoryTitles): self
    {
        return $this->afterCreating(function (CookieService $cookieService) use ($categoryTitles) {
            $query = CookieCategory::query();
            foreach (supportedLocaleKeys() as $localeKey) {
                foreach ($categoryTitles as $categoryTitle) {
                    $query->orWhereJsonContains('title->' . $localeKey, $categoryTitle);
                }
            }
            $categories = $query->get();
            $cookieService->categories()->sync($categories->pluck('id'));
        });
    }
}
