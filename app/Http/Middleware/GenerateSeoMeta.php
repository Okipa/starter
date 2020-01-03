<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle($request, Closure $next)
    {
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
