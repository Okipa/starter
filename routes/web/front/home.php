<?php

use App\Http\Controllers\Front\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/',
    [HomePageController::class, 'show']
)->name('home.page.show');
