<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get(
    Lang::uri('user/profile'),
    [ProfileController::class, 'show']
)->name('profile.edit');
Route::post(
    Lang::uri('user/profile/delete-account'),
    [ProfileController::class, 'deleteAccount']
)->name('profile.deleteAccount');
