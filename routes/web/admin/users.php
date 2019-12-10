<?php

use App\Http\Controllers\Admin\UsersController;

Route::get(Lang::uri('users'), [UsersController::class, 'index'])->name('users.index');
Route::get(Lang::uri('user/create'), [UsersController::class, 'create'])->name('user.create');
Route::post(Lang::uri('user/store'), [UsersController::class, 'store'])->name('user.store');
Route::get(Lang::uri('user/edit/{user}'), [UsersController::class, 'edit'])->name('user.edit');
Route::put(Lang::uri('user/update/{user}'), [UsersController::class, 'update'])->name('user.update');
Route::delete(Lang::uri('user/destroy/{user}'), [UsersController::class, 'destroy'])->name('user.destroy');
Route::get(Lang::uri('user/profile/edit'), [UsersController::class, 'profile'])->name('user.profile.edit');
