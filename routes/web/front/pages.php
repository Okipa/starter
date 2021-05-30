<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PagesController;

Route::get(
    Lang::uri('page/{page:slug}'),
    [PagesController::class, 'show']
)->name('page.show');
