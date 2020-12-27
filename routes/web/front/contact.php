<?php

use App\Http\Controllers\Front\ContactPageController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get(
    '/contact',
    [ContactPageController::class, 'show']
)->name('contact.page.show');
Route::post(
    '/contact/message/send',
    [ContactPageController::class, 'sendMessage']
)->name('contact.sendMessage')->middleware(ProtectAgainstSpam::class);
