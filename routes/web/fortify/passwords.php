<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\PasswordController;

if (Features::enabled(Features::updatePasswords())) {
    Route::put(Lang::uri('/user/password'), [PasswordController::class, 'update'])
        ->middleware(['auth'])
        ->name('user-password.update');
}
