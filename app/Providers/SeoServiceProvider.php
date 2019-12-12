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
        //if (multilingual()) {
            // foreach (supportedLocaleKeys() as $localeKey) {
            //     SEO::metatags()->addAlternateLanguage($localeKey, Route::getLocalizedCurrentUrl($localeKey));
            // }
        //}
        // todo : fix this
        //         SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        //if (multilingual()) {
            // todo : fix this
            //            SEO::opengraph()->addProperty(
            //                'locale:alternate',
            //                implode(',', Arr::pluck(LaravelLocalization::getLocalesOrder(), 'regional'))
            //            );
        //}
    }
}
