<?php

namespace Database\Factories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Todo: update this trait if your app is not multilingual.

trait HasSeoMeta
{
    public function withSeoMeta(array $title = null, array $description = null, string $image = null): self
    {
        return $this->afterCreating(function (Model $model) use ($image, $title, $description) {
            $meta = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $meta['meta_title'][$localeKey] = data_get($title, $localeKey)
                    ?: Str::title($this->faker->words(3, true));
                $meta['meta_description'][$localeKey] = data_get($description, $localeKey) ?: $this->faker->text();
            }
            $model->saveSeoMeta($meta);
            $model->addMedia($image ?: $this->faker->image(null, 600, 600))
                ->preservingOriginal()
                ->toMediaCollection('seo');
        });
    }
}
