<?php

use App\Http\Controllers\Admin\SettingsController;

Route::get(Lang::uri('parameters/edit'), [SettingsController::class, 'index'])->name('settings.edit');
Route::put(Lang::uri('parameters/update'), [SettingsController::class, 'update'])->name('settings.update');
