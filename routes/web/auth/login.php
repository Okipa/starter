<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get(
    Lang::uri('login'),
    [LoginController::class, 'showLoginForm']
)->name('login')->middleware('guest');
Route::post(
    Lang::uri('login'),
    [LoginController::class, 'login']
)->name('login.login')->middleware('guest');
Route::post(
    Lang::uri('logout'),
    [LoginController::class, 'logout']
)->name('logout');
