<?php

return [

    /**
     * The locales you wish to support.
     */
     'supported-locales' => ['fr', 'en'],

    /**
     * If you have a main locale and don't want
     * to prefix it in the URL, specify it here.
     *
     * 'omit_url_prefix_for_locale' => 'en',
     */
    'omit_url_prefix_for_locale' => 'fr',

    /**
     * If you want to automatically set the locale
     * for localized routes set this to true.
     */
    'use_locale_middleware' => true,

    /**
     * Set locales details
     */
    'locales' => [
        'fr' => [
            'name' => 'Français',
            'regional' => 'fr_FR'
        ],
        'en' => [
            'name' => 'English',
            'regional' => 'en_GB'
        ]
    ]

];
