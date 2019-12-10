<?php

use App\Http\Controllers\Admin\AdminController;

Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
