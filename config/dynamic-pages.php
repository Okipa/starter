<?php

return [
    'blocks' => [
        'h1'               => [
            'name'       => 'dynamic-pages.names.h1',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\H1Controller::class,
            'model'      => \App\Models\DynamicPages\H1::class,
        ],
        'text'             => [
            'name'       => 'dynamic-pages.names.text',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\TextController::class,
            'model'      => \App\Models\DynamicPages\Text::class,
        ],
        'two_columns_text' => [
            'name'       => 'dynamic-pages.names.two_columns_text',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\TwoColumnsTextController::class,
            'model'      => \App\Models\DynamicPages\TwoColumnsText::class,
        ],
        'text_image'       => [
            'name'       => 'dynamic-pages.names.text_image',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\TextImageController::class,
            'model'      => \App\Models\DynamicPages\TextImage::class,
        ],
        'image_text'       => [
            'name'       => 'dynamic-pages.names.image_text',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\TextImageController::class,
            'model'      => \App\Models\DynamicPages\TextImage::class,
        ],
    ],
];
