<?php

use Illuminate\Support\Facades\Route;

// Localized ***********************************************************************************************************
Route::localized(function () {

    // Todo: you can remove this block and the routes php files if your app is not multilingual.
    // Todo: Also remove the `Fortify::ignoreRoutes();` line in the `App\Providers\FortifyServiceProvider`.
    // Fortify
    Route::group([
        'namespace' => 'Laravel\Fortify\Http\Controllers',
        'domain' => config('fortify.domain', null),
        'prefix' => config('fortify.path'),
    ], function () {
        Route::group(['middleware' => config('fortify.middleware', ['web'])], static function () {
            require('web/fortify/login.php');
            require('web/fortify/registration.php');
            require('web/fortify/password-reset.php');
            require('web/fortify/email-verification.php');
            require('web/fortify/profile-information.php');
            require('web/fortify/passwords.php');
            require('web/fortify/password-confirmation.php');
            require('web/fortify/two-factor-authentication.php');
        });
    });

    // Admin
    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
        require('web/admin/admin.php');
        require('web/admin/dashboard.php');
        require('web/admin/home.php');
        require('web/admin/news.php');
        require('web/admin/contact.php');
        require('web/admin/pages.php');
        require('web/admin/brickables.php');
        require('web/admin/libraryMedia.php');

        // Password reconfirm protection
        Route::middleware(['password.confirm'])->group(function () {
            require('web/admin/profile.php');
            require('web/admin/users.php');
            require('web/admin/settings.php');
        });
    });

    // Front
    require('web/front/home.php');
    require('web/front/news.php');
    require('web/front/contact.php');
    require('web/front/pages.php');
    require('web/front/rss.php');
    require('web/front/welcome.php');
});

// Not localized *******************************************************************************************************

// Utils
require('web/utils/seo.php');
require('web/utils/download.php');

// 404 fallback catch : do not not place any route declaration under this one ******************************************
require('web/utils/fallback.php');
