<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ContactPageController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get(
    '/contact',
    [ContactPageController::class, 'show']
)->name('contact.page.show');
Route::post(
    '/contact/message/send',
    [ContactPageController::class, 'sendMessage']
)->name('contact.sendMessage')->middleware(ProtectAgainstSpam::class);
