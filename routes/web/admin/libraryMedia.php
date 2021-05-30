<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LibraryMediaCategoriesController;
use App\Http\Controllers\Admin\LibraryMediaFilesController;

// categories
Route::get(
    Lang::uri('library/media/categories'),
    [LibraryMediaCategoriesController::class, 'index']
)->name('libraryMedia.categories.index');
Route::get(
    Lang::uri('library/media/category/create'),
    [LibraryMediaCategoriesController::class, 'create']
)->name('libraryMedia.category.create');
Route::post(
    Lang::uri('library/media/category/store'),
    [LibraryMediaCategoriesController::class, 'store']
)->name('libraryMedia.category.store');
Route::get(
    Lang::uri('library/media/category/{category}/edit'),
    [LibraryMediaCategoriesController::class, 'edit']
)->name('libraryMedia.category.edit');
Route::put(
    Lang::uri('library/media/category/{category}/update'),
    [LibraryMediaCategoriesController::class, 'update']
)->name('libraryMedia.category.update');
Route::delete(
    Lang::uri('library/media/category/{category}/destroy'),
    [LibraryMediaCategoriesController::class, 'destroy']
)->name('libraryMedia.category.destroy');

// files
Route::get(
    Lang::uri('library/media/files'),
    [LibraryMediaFilesController::class, 'index']
)->name('libraryMedia.files.index');
Route::get(
    Lang::uri('library/media/file/create'),
    [LibraryMediaFilesController::class, 'create']
)->name('libraryMedia.file.create');
Route::post(
    Lang::uri('library/media/file/store'),
    [LibraryMediaFilesController::class, 'store']
)->name('libraryMedia.file.store');
Route::get(
    Lang::uri('library/media/file/{file}/edit'),
    [LibraryMediaFilesController::class, 'edit']
)->name('libraryMedia.file.edit');
Route::put(
    Lang::uri('library/media/file/{file}/update'),
    [LibraryMediaFilesController::class, 'update']
)->name('libraryMedia.file.update');
Route::delete(
    Lang::uri('library/media/file/{file}/destroy'),
    [LibraryMediaFilesController::class, 'destroy']
)->name('libraryMedia.file.destroy');
Route::get(
    // ToDo: remove `/{locale?}` from the route if your app is not multilingual.
    Lang::uri('library/media/files/clipboard/content/{file}/{type}/{locale?}'),
    [LibraryMediaFilesController::class, 'clipboardContent']
)->name('libraryMedia.file.clipboardContent');
