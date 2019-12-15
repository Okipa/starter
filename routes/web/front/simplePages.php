<?php

use App\Http\Controllers\Front\SimplePagesController;

Route::get(Lang::uri('page/{page}'), [SimplePagesController::class, 'show'])->name('simplePage.show')->where('url', '.*');
