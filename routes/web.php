<?php

use Illuminate\Support\Facades\Route;

// localized ***********************************************************************************************************
Route::localized(function () {
    // auth
    require('web/auth/login.php');
    require('web/auth/register.php');
    require('web/auth/reset.php');
    require('web/auth/confirm.php');
    require('web/auth/verify.php');
    require('web/auth/welcome.php');

    // admin
    Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
        require('web/admin/admin.php');
        require('web/admin/dashboard.php');
        require('web/admin/home.php');
        require('web/admin/news.php');
        require('web/admin/contact.php');
        require('web/admin/pages.php');
        require('web/admin/brickables.php');
        require('web/admin/libraryMedia.php');

        // password reconfirm protection
        Route::middleware(['password.confirm'])->group(function () {
            require('web/admin/users.php');
            require('web/admin/settings.php');
        });
    });

    // front
    require('web/front/home.php');
    require('web/front/news.php');
    require('web/front/contact.php');
    require('web/front/pages.php');
    require('web/front/rss.php');
});

// not localized *******************************************************************************************************

// utils
require('web/utils/seo.php');
require('web/utils/download.php');

// 404 fallback catch : do not not place any route declaration under this one ******************************************
require('web/utils/fallback.php');
