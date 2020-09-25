<?php

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get(Lang::uri('/login'), [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest'])
    ->name('login');
$limiter = config('fortify.limiters.login');
Route::post(Lang::uri('/login'), [AuthenticatedSessionController::class, 'store'])
    ->middleware(array_filter(['guest', $limiter ? 'throttle:' . $limiter : null]))
    ->name('login.post');
Route::post(Lang::uri('/logout'), [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
