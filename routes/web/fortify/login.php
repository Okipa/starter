<?php

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

if (config('fortify.views', true)) {
    Route::get(Lang::uri('/login'), [AuthenticatedSessionController::class, 'create'])
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('login');
}
$limiter = config('fortify.limiters.login');
Route::post(Lang::uri('/login'), [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter([
        'guest:' . config('fortify.guard'),
        $limiter ? 'throttle:' . $limiter : null,
    ]))
    ->name('login.store');
Route::post(Lang::uri('/logout'), [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
