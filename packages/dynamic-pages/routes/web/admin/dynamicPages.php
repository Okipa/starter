<?php

use DynamicPages\Http\Controllers\Admin\DynamicPageBlocksController;
use DynamicPages\Http\Controllers\Admin\DynamicPages\H1Controller;
use DynamicPages\Http\Controllers\Admin\DynamicPages\TextController;
use DynamicPages\Http\Controllers\Admin\DynamicPages\TwoColumnsTextController;
use DynamicPages\Http\Controllers\Admin\DynamicPages\TextImageController;
use DynamicPages\Http\Controllers\Admin\DynamicPagesController;

Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.index'), [
    DynamicPagesController::class, 'index'
])->name('dynamicPages');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.create'), [
    DynamicPagesController::class, 'create'
])->name('dynamicPage.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.store'), [
    DynamicPagesController::class, 'store'
])->name('dynamicPage.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.edit'), [
    DynamicPagesController::class, 'edit'
])->name('dynamicPage.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.update'), [
    DynamicPagesController::class, 'update'
])->name('dynamicPage.update');
Route::delete(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPages.destroy'), [
    DynamicPagesController::class, 'destroy'
])->name('dynamicPage.destroy');

Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.index'), [
    DynamicPageBlocksController::class, 'index'
])->name('dynamicPageBlocks');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.store'), [
    DynamicPageBlocksController::class, 'store'
])->name('dynamicPageBlock.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.edit'), [
    DynamicPageBlocksController::class, 'edit'
])->name('dynamicPageBlock.edit');
Route::delete(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.destroy'), [
    DynamicPageBlocksController::class, 'destroy'
])->name('dynamicPageBlock.destroy');

Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.h1.create'), [
    H1Controller::class, 'create'
])->name('dynamicPageBlock.h1.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.h1.store'), [
    H1Controller::class, 'store'
])->name('dynamicPageBlock.h1.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.h1.edit'), [
    H1Controller::class, 'edit'
])->name('dynamicPageBlock.h1.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.h1.update'), [
    H1Controller::class, 'update'
])->name('dynamicPageBlock.h1.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text.create'), [
    TextController::class, 'create'
])->name('dynamicPageBlock.text.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text.store'), [
    TextController::class, 'store'
])->name('dynamicPageBlock.text.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text.edit'), [
    TextController::class, 'edit'
])->name('dynamicPageBlock.text.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text.update'), [
    TextController::class, 'update'
])->name('dynamicPageBlock.text.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.two_columns_text.create'), [
    TwoColumnsTextController::class, 'create'
])->name('dynamicPageBlock.two_columns_text.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.two_columns_text.store'), [
    TwoColumnsTextController::class, 'store'
])->name('dynamicPageBlock.two_columns_text.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.two_columns_text.edit'), [
    TwoColumnsTextController::class, 'edit'
])->name('dynamicPageBlock.two_columns_text.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.two_columns_text.update'), [
    TwoColumnsTextController::class, 'update'
])->name('dynamicPageBlock.two_columns_text.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text_image.create'), [
    TextImageController::class, 'create'
])->name('dynamicPageBlock.text_image.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text_image.store'), [
    TextImageController::class, 'store'
])->name('dynamicPageBlock.text_image.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text_image.edit'), [
    TextImageController::class, 'edit'
])->name('dynamicPageBlock.text_image.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages::routes.dynamicPageBlocks.text_image.update'), [
    TextImageController::class, 'update'
])->name('dynamicPageBlock.text_image.update');
