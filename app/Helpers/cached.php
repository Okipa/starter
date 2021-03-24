<?php

use App\Models\Cookies\CookieCategory;
use App\Models\Pages\Page;
use App\Models\Settings\Settings;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

if (! function_exists('settings')) {
    /**
     * @param bool $clearCache
     *
     * @return \App\Models\Settings\Settings
     * @throws \Exception
     */
    function settings(bool $clearCache = false): Settings
    {
        if ($clearCache) {
            cache()->forget('settings');
        }

        return cache()->rememberForever('settings', fn() => Settings::with(['media'])->sole());
    }
}

if (! function_exists('pages')) {
    /**
     * @param bool $clearCache
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    function pages(bool $clearCache = false): Collection
    {
        if ($clearCache) {
            cache()->forget('pages');
        }

        return cache()->rememberForever('pages', fn() => Page::where('active', true)->get());
    }
}

if (! function_exists('cookieCategories')) {
    /**
     * @param bool $clearCache
     *
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    function cookieCategories(bool $clearCache = false): Collection
    {
        if ($clearCache) {
            cache()->forget('cookie_categories');
        }

        return cache()->rememberForever(
            'cookie_categories',
            fn() => CookieCategory::with([
                'services' => fn(BelongsToMany $services) => $services->with(['categories'])->where('active', true),
            ])->whereHas('services')->ordered()->get()
        );
    }
}
