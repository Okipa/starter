<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;

if (Features::enabled(Features::resetPasswords())) {
    Route::get(Lang::uri('/forgot-password'), [PasswordResetLinkController::class, 'create'])
        ->middleware(['guest'])
        ->name('password.request');
    Route::post(Lang::uri('/forgot-password'), [PasswordResetLinkController::class, 'store'])
        ->middleware(['guest'])
        ->name('password.email');
    Route::get(Lang::uri('/reset-password/{token}'), [NewPasswordController::class, 'create'])
        ->middleware(['guest'])
        ->name('password.reset');
    Route::post(Lang::uri('/reset-password'), [NewPasswordController::class, 'store'])
        ->middleware(['guest'])
        ->name('password.update');
}
