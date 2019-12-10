<?php

use App\Http\Controllers\Admin\DynamicPageBlocksController;
use App\Http\Controllers\Admin\DynamicPages\H1Controller;
use App\Http\Controllers\Admin\DynamicPages\ParagraphController;
use App\Http\Controllers\Admin\DynamicPages\TwoColumnsParagraphController;
use App\Http\Controllers\Admin\DynamicPages\ParagraphImageController;
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

Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.index'), [
    DynamicPageBlocksController::class, 'index'
])->name('dynamicPageBlocks');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.store'), [
    DynamicPageBlocksController::class, 'store'
])->name('dynamicPageBlock.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.edit'), [
    DynamicPageBlocksController::class, 'edit'
])->name('dynamicPageBlock.edit');
Route::delete(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.destroy'), [
    DynamicPageBlocksController::class, 'destroy'
])->name('dynamicPageBlock.destroy');

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.h1.create'), [
    H1Controller::class, 'create'
])->name('dynamicPageBlock.h1.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.h1.store'), [
    H1Controller::class, 'store'
])->name('dynamicPageBlock.h1.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.h1.edit'), [
    H1Controller::class, 'edit'
])->name('dynamicPageBlock.h1.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.h1.update'), [
    H1Controller::class, 'update'
])->name('dynamicPageBlock.h1.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph.create'), [
    ParagraphController::class, 'create'
])->name('dynamicPageBlock.paragraph.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph.store'), [
    ParagraphController::class, 'store'
])->name('dynamicPageBlock.paragraph.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph.edit'), [
    ParagraphController::class, 'edit'
])->name('dynamicPageBlock.paragraph.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph.update'), [
    ParagraphController::class, 'update'
])->name('dynamicPageBlock.paragraph.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.two_columns_paragraph.create'), [
    TwoColumnsParagraphController::class, 'create'
])->name('dynamicPageBlock.two_columns_paragraph.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.two_columns_paragraph.store'), [
    TwoColumnsParagraphController::class, 'store'
])->name('dynamicPageBlock.two_columns_paragraph.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.two_columns_paragraph.edit'), [
    TwoColumnsParagraphController::class, 'edit'
])->name('dynamicPageBlock.two_columns_paragraph.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.two_columns_paragraph.update'), [
    TwoColumnsParagraphController::class, 'update'
])->name('dynamicPageBlock.two_columns_paragraph.update');

Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph_image.create'), [
    ParagraphImageController::class, 'create'
])->name('dynamicPageBlock.paragraph_image.create');
Route::post(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph_image.store'), [
    ParagraphImageController::class, 'store'
])->name('dynamicPageBlock.paragraph_image.store');
Route::get(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph_image.edit'), [
    ParagraphImageController::class, 'edit'
])->name('dynamicPageBlock.paragraph_image.edit');
Route::put(LaravelLocalization::transRoute('dynamic-pages.routes.dynamicPageBlocks.paragraph_image.update'), [
    ParagraphImageController::class, 'update'
])->name('dynamicPageBlock.paragraph_image.update');
