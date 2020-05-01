<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Brickables\CarouselBricksController;

Brickables::routes();

// carousel
Route::post(
    Lang::uri('brick/carousel/move/up/{slide}'),
    [CarouselBricksController::class, 'moveUpSlide']
)->name('brick.carousel.slide.move.up');
Route::post(
    Lang::uri('brick/carousel/move/down/{slide}'),
    [CarouselBricksController::class, 'moveDownSlide']
)->name('brick.carousel.slide.move.down');
Route::delete(
    Lang::uri('brick/carousel/slide/destroy/{slide}'),
    [CarouselBricksController::class, 'destroySlide']
)->name('brick.carousel.slide.destroy');
