<?php

use App\Http\Controllers\Brickables\CarouselBrickSlidesController;
use Illuminate\Support\Facades\Route;

Brickables::routes();

// Carousel slides
Route::get(
    Lang::uri('brick/carousel/{brick}/slide/create'),
    [CarouselBrickSlidesController::class, 'create']
)->name('brick.carousel.slide.create');
Route::post(
    Lang::uri('brick/carousel/{brick}/slide/store'),
    [CarouselBrickSlidesController::class, 'store']
)->name('brick.carousel.slide.store');
Route::get(
    Lang::uri('brick/carousel/slide/{slide}/edit'),
    [CarouselBrickSlidesController::class, 'edit']
)->name('brick.carousel.slide.edit');
Route::put(
    Lang::uri('brick/carousel/slide/{slide}/update'),
    [CarouselBrickSlidesController::class, 'update']
)->name('brick.carousel.slide.update');
Route::delete(
    Lang::uri('brick/carousel/slide/{slide}/destroy'),
    [CarouselBrickSlidesController::class, 'destroy']
)->name('brick.carousel.slide.destroy');
Route::post(
    'brick/carousel/slides/reorder',
    [CarouselBrickSlidesController::class, 'reorder']
)->name('brick.carousel.slides.reorder');
