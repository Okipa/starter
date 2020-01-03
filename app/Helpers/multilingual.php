<?php

if (! function_exists('multilingual')) {
    /**
     * @return bool
     */
    function multilingual(): bool
    {
        return count(supportedLocaleKeys()) > 1;
    }
}

if (! function_exists('supportedLocales')) {
    /**
     * @return array
     */
    function supportedLocales(): array
    {
        $locales = [];
        foreach (supportedLocaleKeys() as $localeKey) {
            $locales[$localeKey] = config('localized-routes.locales')[$localeKey];
        }

        return $locales;
    }
}

if (! function_exists('supportedLocaleKeys')) {
    /**
     * @return array
     */
    function supportedLocaleKeys(): array
    {
        return config('localized-routes.supported-locales');
    }
}

if (! function_exists('currentLocale')) {
    /**
     * @param string|null $key
     *
     * @return array|string
     */
    function currentLocale(?string $key)
    {
        $currentLocale = supportedLocales()[app()->getLocale()];

        return $key ? $currentLocale[$key] : $currentLocale;
    }
}
