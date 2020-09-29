<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

if (Features::enabled(Features::registration())) {
    Route::get(Lang::uri('/register'), [RegisteredUserController::class, 'create'])
        ->middleware(['guest'])
        ->name('register');
    Route::post(Lang::uri('/register'), [RegisteredUserController::class, 'store'])
        ->middleware(['guest'])
        ->name('register.store');
}
