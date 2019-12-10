<?php

namespace App\LaravelBootstrapComponents\Form;

use Illuminate\Database\Eloquent\Model;

class MultilingualResolver extends \Okipa\LaravelBootstrapComponents\Form\MultilingualResolver
{
    /**
     * Resolve the multilingual component localized value.
     *
     * @param string $name
     * @param string $locale
     * @param Model|null $model
     *
     * @return string|null
     */
    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->getTranslation($name, $locale);
    }
}
