<?php

namespace App\Components\Form\Multilingual;

use Illuminate\Database\Eloquent\Model;

class Resolver extends \Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver
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
