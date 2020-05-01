<?php

use Illuminate\Support\Facades\Route;
use Spatie\Feed\Http\FeedController;

foreach (config('feed.feeds') as $name => $feed) {
    Route::get(Lang::uri('rss/news'), '\\' . FeedController::class)->name('feeds.' . $name);
}
