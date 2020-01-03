<?php

use App\Http\Controllers\Utils\FallbackController;

Route::fallback([FallbackController::class, 'notFound']);
