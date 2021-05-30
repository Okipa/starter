<?php

use App\Http\Controllers\Admin\CookieCategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CookieServicesController;

// Categories
Route::get(
    Lang::uri('cookie/categories'),
    [CookieCategoriesController::class, 'index']
)->name('cookie.categories.index');
Route::get(
    Lang::uri('cookie/category/create'),
    [CookieCategoriesController::class, 'create']
)->name('cookie.category.create');
Route::post(
    Lang::uri('cookie/category/store'),
    [CookieCategoriesController::class, 'store']
)->name('cookie.category.store');
Route::get(
    Lang::uri('cookie/category/{cookieCategory}/edit'),
    [CookieCategoriesController::class, 'edit']
)->name('cookie.category.edit');
Route::put(
    Lang::uri('cookie/category/{cookieCategory}/update'),
    [CookieCategoriesController::class, 'update']
)->name('cookie.category.update');
Route::delete(
    Lang::uri('cookie/category/{cookieCategory}/destroy'),
    [CookieCategoriesController::class, 'destroy']
)->name('cookie.category.destroy');
Route::post(
    Lang::uri('cookie/categories/reorder'),
    [CookieCategoriesController::class, 'reorder']
)->name('cookie.categories.reorder');

// Services
Route::get(
    Lang::uri('cookie/services'),
    [CookieServicesController::class, 'index']
)->name('cookie.services.index');
Route::get(
    Lang::uri('cookie/service/create'),
    [CookieServicesController::class, 'create']
)->name('cookie.service.create');
Route::post(
    Lang::uri('cookie/service/store'),
    [CookieServicesController::class, 'store']
)->name('cookie.service.store');
Route::get(
    Lang::uri('cookie/service/{cookieService}/edit'),
    [CookieServicesController::class, 'edit']
)->name('cookie.service.edit');
Route::put(
    Lang::uri('cookie/service/{cookieService}/update'),
    [CookieServicesController::class, 'update']
)->name('cookie.service.update');
Route::delete(
    Lang::uri('cookie/service/{cookieService}/destroy'),
    [CookieServicesController::class, 'destroy']
)->name('cookie.service.destroy');
