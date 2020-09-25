<?php

use Laravel\Fortify\Http\Controllers\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;

Route::get(Lang::uri('/user/confirm-password'), [ConfirmablePasswordController::class, 'show'])
    ->middleware(['auth'])
    ->name('password.confirm');
Route::post(Lang::uri('/user/confirm-password'), [ConfirmablePasswordController::class, 'store'])
    ->middleware(['auth'])
    ->name('password.confirm.post');
Route::get(Lang::uri('/user/confirmed-password-status'), [ConfirmedPasswordStatusController::class, 'show'])
    ->middleware(['auth'])
    ->name('password.confirmation');
