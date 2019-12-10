<?php

use App\Http\Controllers\Front\DynamicPagesController;

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.show'), [
    DynamicPagesController::class,
    'show',
])->name('dynamicPage.show')->where('url', '.*');
