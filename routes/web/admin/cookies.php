<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CookieServicesController;

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
