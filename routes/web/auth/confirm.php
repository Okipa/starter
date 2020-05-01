<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ConfirmPasswordController;

Route::get(
    Lang::uri('password/confirm'),
    [ConfirmPasswordController::class, 'showConfirmForm']
)->name('password.confirm')->middleware('auth');
Route::post(
    Lang::uri('password/confirm'),
    [ConfirmPasswordController::class, 'confirm']
)->middleware('auth');
