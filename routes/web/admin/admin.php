<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get(
    '/',
    [AdminController::class, 'index']
)->name('admin.index');
