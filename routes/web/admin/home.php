<?php

use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\HomeSlidesController;

// page
Route::get(Lang::uri('home/page/edit'), [HomePageController::class, 'edit'])->name('home.page.edit');
Route::put(Lang::uri('home/page/update'), [HomePageController::class, 'update'])->name('home.page.update');

// slides
Route::get(Lang::uri('home/slides'), [HomeSlidesController::class, 'index'])->name('home.slides.index');
Route::get(Lang::uri('home/slide/create'), [HomeSlidesController::class, 'create'])->name('home.slide.create');
Route::post(Lang::uri('home/slide/store'), [HomeSlidesController::class, 'store'])->name('home.slide.store');
Route::get(Lang::uri('home/slide/edit/{homeSlide}'), [HomeSlidesController::class, 'edit'])->name('home.slide.edit');
Route::put(Lang::uri('home/slide/update/{homeSlide}'), [HomeSlidesController::class, 'update'])->name('home.slide.update');
Route::delete(Lang::uri('home/slide/destroy/{homeSlide}'), [HomeSlidesController::class, 'destroy'])->name('home.slide.destroy');
Route::post(Lang::uri('home/slides/reorganize'), [HomeSlidesController::class, 'reorganize'])->name('home.slides.reorganize');
