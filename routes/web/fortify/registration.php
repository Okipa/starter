<?php

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

if (Features::enabled(Features::registration())) {
    if (config('fortify.views', true)) {
        Route::get(Lang::uri('/register'), [RegisteredUserController::class, 'create'])
            ->middleware(['guest:' . config('fortify.guard')])
            ->name('register');
    }
    Route::post(Lang::uri('/register'), [RegisteredUserController::class, 'store'])
        ->middleware(['guest:' . config('fortify.guard')])
        ->name('register.store');
}
