<?php

use App\Http\Controllers\Front\SimplePagesController;

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.show'), [
    SimplePagesController::class,
    'show',
])->name('dynamicPage.show')->where('url', '.*');
