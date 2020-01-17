<?php

use App\Models\Settings\Settings;
use App\Models\Pages\Page;
use Illuminate\Support\Collection;

if (! function_exists('settings')) {
    /**
     * Get and cache settings.
     *
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

        return cache()->rememberForever('settings', function () {
            return (new Settings)->with(['media'])->firstOrFail();
        });
    }
}

if (! function_exists('pages')) {
    /**
     * Get and cache pages.
     *
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

        return cache()->rememberForever('pages', function () {
            return (new Page)->where('active', true)->get();
        });
    }
}
