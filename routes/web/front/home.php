<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomePageController;

Route::get(
    '/',
    [HomePageController::class, 'show']
)->name('home');
