<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;

if (Features::enabled(Features::twoFactorAuthentication())) {
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    if (config('fortify.views', true)) {
        Route::get(Lang::uri('/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:' . config('fortify.guard')])
            ->name('two-factor.login');
    }
    Route::post(Lang::uri('/two-factor-challenge'), [TwoFactorAuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:' . config('fortify.guard'),
            $twoFactorLimiter ? 'throttle:' . $twoFactorLimiter : null,
        ]))
        ->name('two-factor.login.store');
    $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
        ? ['auth', 'password.confirm']
        : ['auth'];
    Route::post(Lang::uri('/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'store'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.activate');
    Route::delete(Lang::uri('/user/two-factor-authentication'), [TwoFactorAuthenticationController::class, 'destroy'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.deactivate');
    Route::get(Lang::uri('/user/two-factor-qr-code'), [TwoFactorQrCodeController::class, 'show'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.qr');
    Route::get(Lang::uri('/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'index'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.recovery');
    Route::post(Lang::uri('/user/two-factor-recovery-codes'), [RecoveryCodeController::class, 'store'])
        ->middleware($twoFactorMiddleware)
        ->name('two-factor.recovery-codes');
}
