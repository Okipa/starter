<?php

use App\Http\Controllers\Admin\ContactPageController;

Route::get(LaravelLocalization::transRoute('routes.contact.page.edit'), [
    ContactPageController::class,
    'edit',
])->name('contact.page.edit');
Route::put(LaravelLocalization::transRoute('routes.contact.page.update'), [
    ContactPageController::class,
    'update',
])->name('contact.page.update');

