<?php

use App\Http\Controllers\Admin\SettingsController;

Route::get(LaravelLocalization::transRoute('routes.settings.index'), [
    SettingsController::class,
    'index',
])->name('settings')->middleware('password.confirm');
Route::put(LaravelLocalization::transRoute('routes.settings.update'), [
    SettingsController::class,
    'update',
])->name('settings.update');
