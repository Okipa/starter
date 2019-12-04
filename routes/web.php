<?php

// not localized routes ************************************************************************************************
Route::namespace('Utils')->group(function () {
    require('web/utils/seo.php');
    require('web/utils/download.php');
});
// localized routes ****************************************************************************************************
Route::prefix(LaravelLocalization::setLocale())
//    ->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])
    ->group(function () {
        // auth ********************************************************************************************************
        require('web/auth/login.php');
        require('web/auth/password.php');
        // require('web/auth/register.php'); // todo : uncomment if this feature is needed
        // require('web/auth/verification.php'); // todo : uncomment if this feature is needed
        // admin *******************************************************************************************************
        Route::prefix('admin')->middleware([
            'auth',
            // 'verified', // todo : uncomment if this feature is needed
        ])->group(function () {
            require('web/admin/admin.php');
            require('web/admin/dashboard.php');
            require('web/admin/home.php');
            require('web/admin/news.php');
            require('web/admin/contact.php');
            require('web/admin/simplePages.php');
            require('web/admin/libraryMedia.php');
            // sensitive data
            Route::middleware(['password.confirm'])->group(function () {
                require('web/admin/settings.php');
                require('web/admin/users.php');
            });
        });
        // front *******************************************************************************************************
        require('web/front/home.php');
        require('web/front/news.php');
        // /!\ any declaration under this one will be lost /!\
        require('web/front/simplePages.php');
    });
