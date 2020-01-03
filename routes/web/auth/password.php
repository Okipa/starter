<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get(
    Lang::uri('password/reinitialization'),
    [ForgotPasswordController::class, 'showLinkRequestForm']
)->name('password.request');
Route::post(
    Lang::uri('password/reinitialization/email'),
    [ForgotPasswordController::class, 'sendResetLinkEmail']
)->name('password.email');
Route::get(
    Lang::uri('password/reinitialization/{token}'),
    [ResetPasswordController::class, 'showResetForm']
)->name('password.update');
Route::post(
    Lang::uri('password/reset'),
    [ResetPasswordController::class, 'reset']
)->name('password.reset');
Route::get(
    Lang::uri('password/verification'),
    [ConfirmPasswordController::class, 'showConfirmForm']
)->name('password.confirm')->middleware('auth');
Route::post(
    Lang::uri('password/confirm'),
    [ConfirmPasswordController::class, 'confirm']
)->name('password.reconfirm')->middleware('auth');
