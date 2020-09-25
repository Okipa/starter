<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;

Route::get(
    Lang::uri('users'),
    [UsersController::class, 'index']
)->name('users.index');
Route::get(
    Lang::uri('user/create'),
    [UsersController::class, 'create']
)->name('user.create');
Route::post(
    Lang::uri('user/store'),
    [UsersController::class, 'store']
)->name('user.store');
Route::get(
    Lang::uri('user/{user}/edit'),
    [UsersController::class, 'edit']
)->name('user.edit');
Route::put(
    Lang::uri('user/{user}/update'),
    [UsersController::class, 'update']
)->name('user.update');
Route::delete(
    Lang::uri('user/{user}/destroy'),
    [UsersController::class, 'destroy']
)->name('user.destroy');
Route::get(
    Lang::uri('user/profile-information'),
    [UsersController::class, 'profile']
)->name('profile.information');
