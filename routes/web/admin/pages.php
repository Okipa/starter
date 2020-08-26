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
    Lang::uri('page/{page}/edit'),
    [PagesController::class, 'edit']
)->name('page.edit');
Route::put(
    Lang::uri('page/{page}/update'),
    [PagesController::class, 'update']
)->name('page.update');
Route::delete(
    Lang::uri('page/{page}/destroy'),
    [PagesController::class, 'destroy']
)->name('page.destroy');
