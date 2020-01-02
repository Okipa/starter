<?php

// not localized routes ************************************************************************************************
require('web/admin/admin.php');
// utils
require('web/utils/seo.php');
require('web/utils/download.php');
// localized routes ****************************************************************************************************
Route::localized(function () {
    // auth
    require('web/auth/login.php');
    require('web/auth/password.php');
    require('web/auth/register.php'); // todo : comment if this feature is not needed
    require('web/auth/verification.php'); // todo : uncomment if this feature is not needed
    // admin
    Route::prefix('admin')->middleware([
        'auth',
        'verified', // todo : comment if this feature is not needed
    ])->group(function () {
        require('web/admin/dashboard.php');
        require('web/admin/home.php');
        require('web/admin/news.php');
        require('web/admin/contact.php');
        require('web/admin/simplePages.php');
        require('web/admin/libraryMedia.php');
        // sensitive data
        Route::middleware(['password.confirm'])->group(function () {
            require('web/admin/users.php');
            require('web/admin/settings.php');
        });
    });
    // front
    require('web/front/home.php');
    require('web/front/news.php');
    require('web/front/contact.php');
    require('web/front/simplePages.php');
});
