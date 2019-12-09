<?php

use App\Http\Controllers\Admin\DynamicPageBlocksController;
use App\Http\Controllers\Admin\DynamicPagesController;

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.index'), [
    DynamicPagesController::class, 'index'
])->name('dynamicPages');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.create'), [
    DynamicPagesController::class, 'create'
])->name('dynamicPage.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.store'), [
    DynamicPagesController::class, 'store'
])->name('dynamicPage.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.edit'), [
    DynamicPagesController::class, 'edit'
])->name('dynamicPage.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.update'), [
    DynamicPagesController::class, 'update'
])->name('dynamicPage.update');
Route::delete(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPages.destroy'), [
    DynamicPagesController::class, 'destroy'
])->name('dynamicPage.destroy');

Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.store'), [
    DynamicPageBlocksController::class, 'store'
])->name('dynamicPageBlock.store');
