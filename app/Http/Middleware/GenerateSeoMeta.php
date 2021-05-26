<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Route;
use SEO;

class GenerateSeoMeta
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next)
    {
        // ToDo: replace this block by `SEO::opengraph()->addProperty('locale', 'fr_FR')`
        // if your app is not multilingual.
        SEO::opengraph()->addProperty('locale', currentLocale()['regional']);
        if (multilingual()) {
            foreach (supportedLocaleKeys() as $localeKey) {
                SEO::metatags()->addAlternateLanguage($localeKey, Route::localizedUrl($localeKey));
            }
            SEO::opengraph()->addProperty('locale:alternate', Arr::pluck(supportedLocales(), 'regional'));
        }

        return $next($request);
    }
}
