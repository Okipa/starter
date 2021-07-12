<?php

namespace Database\Factories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

// Todo: update this trait if your app is not multilingual.

trait HasSeoMeta
{
    /**
     * @param array|null $title
     * @param array|null $description
     * @param string|null $image
     *
     * @return $this
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    public function withSeoMeta(array $title = null, array $description = null, string $image = null): self
    {
        return $this->afterCreating(function (Model $model) use ($image, $title, $description) {
            $meta = [];
            foreach (supportedLocaleKeys() as $localeKey) {
                $meta['meta_title'][$localeKey] = data_get($title, $localeKey)
                    ?: Str::title($this->faker->words(3, true));
                $meta['meta_description'][$localeKey] = data_get($description, $localeKey) === 'dummy'
                    ? $this->faker->text()
                    : data_get($description, $localeKey);
            }
            $model->saveSeoMeta($meta);
            if ($image) {
                /** @var \Spatie\MediaLibrary\HasMedia $model */
                $image === 'dummy'
                    ? $model->addMedia($this->faker->image(null, 600, 600))->toMediaCollection('seo')
                    : $model->addMedia($image)->preservingOriginal()->toMediaCollection('seo');
            }
        });
    }
}
