<?php

use Illuminate\Support\Facades\Route;

// ToDo: globally remove all `Lang::uri()` usage if your app is not multilingual.

// ToDo: remove localized group if your app is not multilingual.
// Localized ***********************************************************************************************************
Route::localized(function () {

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
            require('web/admin/cookies.php');
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

// ToDo: remove this route if your app is not multilingual.
// 404 fallback catch: do not not place any route declaration under this one ******************************************
require('web/utils/fallback.php');
