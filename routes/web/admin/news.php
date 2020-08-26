<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsArticlesController;
use App\Http\Controllers\Admin\NewsCategoriesController;
use App\Http\Controllers\Admin\NewsPageController;

// page
Route::get(
    Lang::uri('news/page/edit'),
    [NewsPageController::class, 'edit']
)->name('news.page.edit');
Route::put(
    Lang::uri('news/page/update'),
    [NewsPageController::class, 'update']
)->name('news.page.update');

// categories
Route::get(
    Lang::uri('news/categories'),
    [NewsCategoriesController::class, 'index']
)->name('news.categories.index');
Route::get(
    Lang::uri('news/category/create'),
    [NewsCategoriesController::class, 'create']
)->name('news.category.create');
Route::post(
    Lang::uri('news/category/store'),
    [NewsCategoriesController::class, 'store']
)->name('news.category.store');
Route::get(
    Lang::uri('news/category/{category}/edit'),
    [NewsCategoriesController::class, 'edit']
)->name('news.category.edit');
Route::put(
    Lang::uri('news/category/{category}/update'),
    [NewsCategoriesController::class, 'update']
)->name('news.category.update');
Route::delete(
    Lang::uri('news/category/{category}/destroy'),
    [NewsCategoriesController::class, 'destroy']
)->name('news.category.destroy');

// articles
Route::get(
    Lang::uri('news/articles'),
    [NewsArticlesController::class, 'index']
)->name('news.articles.index');
Route::get(
    Lang::uri('news/article/create'),
    [NewsArticlesController::class, 'create']
)->name('news.article.create');
Route::post(
    Lang::uri('news/article/store'),
    [NewsArticlesController::class, 'store']
)->name('news.article.store');
Route::get(
    Lang::uri('news/article/{article}/edit'),
    [NewsArticlesController::class, 'edit']
)->name('news.article.edit');
Route::put(
    Lang::uri('news/article/{article}/update'),
    [NewsArticlesController::class, 'update']
)->name('news.article.update');
Route::delete(
    Lang::uri('news/article/{article}/destroy'),
    [NewsArticlesController::class, 'destroy']
)->name('news.article.destroy');
