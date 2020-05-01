<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\PagesController;

Route::get(
    Lang::uri('page/{page:url}'),
    [PagesController::class, 'show']
)->name('page.show')->where('url', '.*');
