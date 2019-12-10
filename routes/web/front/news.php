<?php

use App\Http\Controllers\Front\NewsArticlesController;

Route::get(Lang::uri('news'), [NewsArticlesController::class, 'index'])->name('news');
Route::get(Lang::uri('news/{url}'), [NewsArticlesController::class, 'show'])->name('news.article.show')->where('url', '.*');
