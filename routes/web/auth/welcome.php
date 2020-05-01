<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\WelcomeController;
use Spatie\WelcomeNotification\WelcomesNewUsers;

Route::get(
    Lang::uri('welcome/{user}'),
    [WelcomeController::class, 'showWelcomeForm']
)->name('password.welcome')->middleware(WelcomesNewUsers::class);
Route::post(
    Lang::uri('welcome/{user}'),
    [WelcomeController::class, 'savePassword']
)->middleware(WelcomesNewUsers::class);
