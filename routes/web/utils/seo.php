<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utils\SeoController;

Route::get(
    'robots.txt',
    [SeoController::class, 'robotsTxt']
);
