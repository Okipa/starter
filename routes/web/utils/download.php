<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Utils\DownloadController;

Route::get(
    'download',
    [DownloadController::class, 'file']
)->name('download.file');
