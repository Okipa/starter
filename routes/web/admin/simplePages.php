<?php

use App\Http\Controllers\Admin\SimplePagesController;

Route::get(Lang::uri('simple-pages'), [SimplePagesController::class, 'index'])->name('simplePages.index');
Route::get(Lang::uri('simple-page/create'), [SimplePagesController::class, 'create'])->name('simplePage.create');
Route::post(Lang::uri('simple-page/store'), [SimplePagesController::class, 'store'])->name('simplePage.store');
Route::get(Lang::uri('simple-page/edit/{simplePage}'), [SimplePagesController::class, 'edit'])->name('simplePage.edit');
Route::put(Lang::uri('simple-page/update/{simplePage}'), [SimplePagesController::class, 'update'])->name('simplePage.update');
Route::delete(Lang::uri('simple-page/destroy/{simplePage}'), [SimplePagesController::class, 'destroy'])->name('simplePage.destroy');
