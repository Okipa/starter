<?php

use App\Http\Controllers\Front\NewsArticlesController;
use App\Http\Controllers\Front\NewsPageController;

// page
Route::get(
    Lang::uri('news'),
    [NewsPageController::class, 'show']
)->name('news');

// articles
Route::get(
    Lang::uri('news/{article}'),
    [NewsArticlesController::class, 'show']
)->name('news.article.show')->where('url', '.*');
