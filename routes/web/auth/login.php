<?php

use App\Http\Controllers\Auth\LoginController;

Route::get(
    Lang::uri('connection'),
    [LoginController::class, 'showLoginForm']
)->name('login')->prefix('admin')->middleware('guest');
Route::post(
    Lang::uri('login'),
    [LoginController::class, 'login']
)->name('login.login')->middleware('guest');
Route::post(
    Lang::uri('logout'),
    [LoginController::class, 'logout']
)->name('logout')->middleware('auth');
