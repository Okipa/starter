<?php

use App\Http\Controllers\Front\PagesController;

Route::get(
    Lang::uri('page/{page}'),
    [PagesController::class, 'show']
)->name('page.show')->where('url', '.*');
