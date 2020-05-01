<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactPageController;

Route::get(
    Lang::uri('contact/page/edit'),
    [ContactPageController::class, 'edit']
)->name('contact.page.edit');
Route::put(
    Lang::uri('contact/page/update'),
    [ContactPageController::class, 'update']
)->name('contact.page.update');
