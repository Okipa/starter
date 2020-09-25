<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

if (Features::enabled(Features::emailVerification())) {
    Route::get(Lang::uri('/email/verify'), [EmailVerificationPromptController::class, '__invoke'])
        ->middleware(['auth'])
        ->name('verification.notice');
    Route::get(Lang::uri('/email/verify/{id}/{hash}'), [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post(Lang::uri('/email/verification-notification'), [
        EmailVerificationNotificationController::class,
        'store',
    ])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');
}
