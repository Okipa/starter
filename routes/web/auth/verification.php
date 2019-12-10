<?php

use App\Http\Controllers\Auth\VerificationController;

Route::get(Lang::uri('email/verification'), [VerificationController::class, 'show'])->name('verification.notice')->middleware('auth');
Route::get(Lang::uri('email/verification/{id}'), [VerificationController::class, 'verify'])->name('verification.verify')->middleware('auth', 'signed', 'throttle:6,1');
Route::post(Lang::uri('email/verification/resend'), [VerificationController::class, 'resend'])->name('verification.resend')->middleware('auth', 'throttle:6,1');
