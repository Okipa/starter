<?php

use App\Http\Controllers\Front\ContactPageController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/contact',
    [ContactPageController::class, 'show']
)->name('contact.page.show');
