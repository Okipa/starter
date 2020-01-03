<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;
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
//        if (multilingual()) {
//            foreach (supportedLocaleKeys() as $localeKey) {
//                SEO::metatags()->addAlternateLanguage($localeKey, Route::localizedUrl($localeKey));
//            }
//        }
        SEO::opengraph()->addProperty('locale', currentLocale('regional'));
        if (multilingual()) {
            SEO::opengraph()->addProperty(
                'locale:alternate',
                collect(supportedLocales())->pluck('regional')->implode(',')
            );
        }
    }
}
