<?php

Route::group([
    'as' => 'dynamic-pages::',
    'middleware' => [ 'web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ],
    'prefix' => LaravelLocalization::setLocale(),
], function () {
    require __DIR__ . '/web/admin/dynamicPages.php';
    require __DIR__ . '/web/front/dynamicPages.php';
});
