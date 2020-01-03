<?php

use App\Http\Controllers\Auth\RegisterController;

Route::get(Lang::uri('registration'), [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
Route::post(Lang::uri('register'), [RegisterController::class, 'register'])
    ->name('register.register')
    ->middleware('guest');
