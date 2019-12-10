<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
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
        if (multilingual()) {
            // todo : fix this
//            foreach (config('localized-routes.supported-locales') as $locale) {
//                 SEO::metatags()->addAlternateLanguage($locale, LaravelLocalization::getLocalizedURL($locale));
//            }
        }
        // todo : fix this
//         SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if (multilingual()) {
            // todo : fix this
//            SEO::opengraph()->addProperty(
//                'locale:alternate',
//                implode(',', Arr::pluck(LaravelLocalization::getLocalesOrder(), 'regional'))
//            );
        }
    }
}
