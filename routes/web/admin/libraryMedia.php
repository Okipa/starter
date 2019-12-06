<?php

use App\Http\Controllers\Admin\LibraryMediaCategoriesController;
use App\Http\Controllers\Admin\LibraryMediaFilesController;

// categories
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.categories.index'), [
    LibraryMediaCategoriesController::class,
    'index',
])->name('libraryMedia.categories.index');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.categories.create'), [
    LibraryMediaCategoriesController::class,
    'create',
])->name('libraryMedia.category.create');
Route::post(LaravelLocalization::transRoute('routes.libraryMedia.categories.store'), [
    LibraryMediaCategoriesController::class,
    'store',
])->name('libraryMedia.category.store');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.categories.edit'), [
    LibraryMediaCategoriesController::class,
    'edit',
])->name('libraryMedia.category.edit');
Route::put(LaravelLocalization::transRoute('routes.libraryMedia.categories.update'), [
    LibraryMediaCategoriesController::class,
    'update',
])->name('libraryMedia.category.update');
Route::delete(LaravelLocalization::transRoute('routes.libraryMedia.categories.destroy'), [
    LibraryMediaCategoriesController::class,
    'destroy',
])->name('libraryMedia.category.destroy');
// files
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.files.index'), [
    LibraryMediaFilesController::class, 'index',
])->name('libraryMedia.files.index');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.files.create'), [
    LibraryMediaFilesController::class, 'create',
])->name('libraryMedia.file.create');
Route::post(LaravelLocalization::transRoute('routes.libraryMedia.files.store'), [
    LibraryMediaFilesController::class, 'store',
])->name('libraryMedia.file.store');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.files.edit'), [
    LibraryMediaFilesController::class, 'edit',
])->name('libraryMedia.file.edit');
Route::put(LaravelLocalization::transRoute('routes.libraryMedia.files.update'), [
    LibraryMediaFilesController::class, 'update',
])->name('libraryMedia.file.update');
Route::delete(LaravelLocalization::transRoute('routes.libraryMedia.files.destroy'), [
    LibraryMediaFilesController::class, 'destroy',
])->name('libraryMedia.file.destroy');
Route::get(LaravelLocalization::transRoute('routes.libraryMedia.files.clipboardContent'), [
    LibraryMediaFilesController::class, 'clipboardContent',
])->name('libraryMedia.file.clipboardContent');
