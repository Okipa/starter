<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;

if (Features::enabled(Features::twoFactorAuthentication())) {
    Route::get(Lang::uri('/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'create'])
        ->middleware(['guest'])
        ->name('two-factor.login');
    Route::post(Lang::uri('/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'store'])
        ->middleware(['guest']);
    $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
        ? ['auth', 'password.confirm']
        : ['auth'];
    Route::post(Lang::uri('/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
        ->middleware($twoFactorMiddleware);
    Route::delete(Lang::uri('/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
        ->middleware($twoFactorMiddleware);
    Route::get(Lang::uri('/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
        ->middleware($twoFactorMiddleware);
    Route::get(Lang::uri('/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
        ->middleware($twoFactorMiddleware);
    Route::post(Lang::uri('/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
        ->middleware($twoFactorMiddleware);
}
