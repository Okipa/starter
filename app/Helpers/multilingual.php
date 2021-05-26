<?php

if (! function_exists('multilingual')) {
    /**
     * Check if the app is in multilingual mode.
     *
     * @return bool
     */
    function multilingual(): bool
    {
        return count(supportedLocaleKeys()) > 1;
    }
}

if (! function_exists('supportedLocales')) {
    /**
     * Get supported locales.
     *
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
     * Get supported locale keys.
     *
     * @return array
     */
    function supportedLocaleKeys(): array
    {
        return config('localized-routes.supported-locales');
    }
}

if (! function_exists('currentLocale')) {
    function currentLocale(): array|string
    {
        return supportedLocales()[app()->getLocale()];
    }
}

if (! function_exists('translatedData')) {
    function translatedData(mixed $target, $key = null, string $locale = null): array|string|null
    {
        $data = $key ? data_get($target, $key) : $target;
        $locale = $locale ?: app()->getLocale();

        return is_array($data) ? data_get($data, $locale) : $data;
    }
}

if (! function_exists('localizeRules')) {
    function localizeRules(array $rules): array
    {
        if (! multilingual()) {
            return $rules;
        }
        $localizedRules = [];
        foreach ($rules as $ruleKey => $ruleDetails) {
            foreach (supportedLocaleKeys() as $locale) {
                $localizedRules[$ruleKey . '.' . $locale] = $ruleDetails;
            }
        }

        return $localizedRules;
    }
}
