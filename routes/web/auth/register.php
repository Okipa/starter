<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get(
    Lang::uri('register'),
    [RegisterController::class, 'showRegistrationForm']
)->name('register')->middleware('guest');
Route::post(
    Lang::uri('register'),
    [RegisterController::class, 'register']
)->name('register')->middleware('guest');
