<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use LaravelLocalization;
use SEO;

class SeoServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     * @throws \Exception
     */
    public function boot()
    {
        $severalLanguages = count(LaravelLocalization::getSupportedLocales()) > 1;
        if ($severalLanguages) {
            foreach (array_keys(LaravelLocalization::getLocalesOrder()) as $localCode) {
                SEO::metatags()->addAlternateLanguage($localCode, LaravelLocalization::getLocalizedURL($localCode));
            }
        }
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($severalLanguages) {
            SEO::opengraph()->addProperty(
                'locale:alternate',
                implode(',', Arr::pluck(LaravelLocalization::getLocalesOrder(), 'regional'))
            );
        }
    }
}
