<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomePageController;

// page
Route::get(
    Lang::uri('home/page/edit'),
    [HomePageController::class, 'edit']
)->name('home.page.edit');
Route::put(
    Lang::uri('home/page/update'),
    [HomePageController::class, 'update']
)->name('home.page.update');
