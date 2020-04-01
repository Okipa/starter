<?php

namespace App\Components\Form\Multilingual;

use Illuminate\Database\Eloquent\Model;

class Resolver extends \Okipa\LaravelBootstrapComponents\Components\Form\Multilingual\Resolver
{
    public function resolveLocalizedModelValue(string $name, string $locale, ?Model $model): ?string
    {
        return optional($model)->getTranslation($name, $locale);
    }
}
