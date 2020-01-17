<?php

return [

    /*
     * The fully qualified class names of the classes that will be used for the brickables management.
     * Each class can be overridden in each brickable itself to customize treatments.
     */
    'bricks' => [
        'model' => Okipa\LaravelBrickables\Models\Brick::class,
        'controller' => App\Http\Controllers\Brickables\BricksController::class,
    ],

    /*
     * Register here the available brickables.
     * Brickables will not be available for use if they are not declared here.
     */
    'registered' => [
        App\Brickables\OneTextColumn::class,
        App\Brickables\TwoTextColumns::class,
        App\Brickables\TwoTextImageColumns::class,
        // add your content brick type configurations here ...
    ],

];
