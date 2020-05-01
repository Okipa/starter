<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utils\Error404Controller;
use CodeZero\LocalizedRoutes\Middleware\SetLocale;

Route::fallback([Error404Controller::class, 'apiResponse'])->middleware(SetLocale::class);
