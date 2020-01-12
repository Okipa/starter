<?php

use Okipa\LaravelBrickables\Controllers\BricksController;

Route::get('brick/create', [BricksController::class, 'create'])->name('brick.create');
Route::post('brick/store', [BricksController::class, 'store'])->name('brick.store');
Route::get('brick/edit/{brick}', [BricksController::class, 'edit'])->name('brick.edit');
Route::put('brick/update/{brick}', [BricksController::class, 'update'])->name('brick.update');
Route::delete('brick/destroy/{brick}', [BricksController::class, 'destroy'])->name('brick.destroy');
