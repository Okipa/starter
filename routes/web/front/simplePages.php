<?php

use App\Http\Controllers\Front\SimplePagesController;

Route::get(Lang::uri('page/{url}'), [SimplePagesController::class, 'show'])->name('simplePage.show')->where('url', '.*');
