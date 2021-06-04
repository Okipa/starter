<?php

use Illuminate\Support\Facades\Route;
use Spatie\Feed\Helpers\Path;
use Spatie\Feed\Http\FeedController;

foreach (config('feed.feeds') as $name => $configuration) {
    Route::get(Lang::uri($configuration['url']), '\\' . FeedController::class)->name('feeds.' . $name);
}
