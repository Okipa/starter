<?php

use App\Http\Controllers\Admin\LibraryMediaController;

Route::get(LaravelLocalization::transRoute('routes.libraryMedia.index'), [
    LibraryMediaController::class, 'index'
])->name('libraryMedia.index');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.create'), [
    LibraryMediaController::class, 'create'
])->name('libraryMedia.create');
Route::post(LaravelLocalization::transRoute('routes.libraryMedia.store'), [
    LibraryMediaController::class, 'store'
])->name('libraryMedia.store');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.edit'), [
    LibraryMediaController::class, 'edit'
])->name('libraryMedia.edit');
Route::put(LaravelLocalization::transRoute('routes.libraryMedia.update'), [
    LibraryMediaController::class, 'update'
])->name('libraryMedia.update');
Route::delete(LaravelLocalization::transRoute('routes.libraryMedia.destroy'), [
    LibraryMediaController::class, 'destroy'
])->name('libraryMedia.destroy');
