<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get(
    Lang::uri('password/reset'),
    [ForgotPasswordController::class, 'showLinkRequestForm']
)->name('password.request');
Route::post(
    Lang::uri('password/email'),
    [ForgotPasswordController::class, 'sendResetLinkEmail']
)->name('password.email');
Route::get(
    Lang::uri('password/reset/{token}'),
    [ResetPasswordController::class, 'showResetForm']
)->name('password.reset');
Route::post(
    Lang::uri('password/reset'),
    [ResetPasswordController::class, 'reset']
)->name('password.update');
