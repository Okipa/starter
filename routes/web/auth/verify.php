<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;

Route::get(
    Lang::uri('email/verify'),
    [VerificationController::class, 'show']
)->name('verification.notice')->middleware('auth');
Route::get(
    Lang::uri('email/verify/{id}/{hash}'),
    [VerificationController::class, 'verify']
)->name('verification.verify')->middleware('auth', 'signed', 'throttle:6,1');
Route::post(
    Lang::uri('email/resend'),
    [VerificationController::class, 'resend']
)->name('verification.resend')->middleware('auth', 'throttle:6,1');
