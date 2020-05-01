<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PagesController;

Route::get(
    Lang::uri('pages'),
    [PagesController::class, 'index']
)->name('pages.index');
Route::get(
    Lang::uri('page/create'),
    [PagesController::class, 'create']
)->name('page.create');
Route::post(
    Lang::uri('page/store'),
    [PagesController::class, 'store']
)->name('page.store');
Route::get(
    Lang::uri('page/edit/{page}'),
    [PagesController::class, 'edit']
)->name('page.edit');
Route::put(
    Lang::uri('page/update/{page}'),
    [PagesController::class, 'update']
)->name('page.update');
Route::delete(
    Lang::uri('page/destroy/{page}'),
    [PagesController::class, 'destroy']
)->name('page.destroy');
