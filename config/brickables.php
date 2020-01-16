<?php

return [

    /*
     * The fully qualified class name of the Brick model associated by default to all brickables.
     */
    'defaultBrickModel' => App\Models\Brick::class,

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
