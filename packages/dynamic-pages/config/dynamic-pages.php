<?php
return [
    'blocks' => [
        'h1'               => [
            'name'       => 'dynamic-pages::names.h1',
            'controller' => \DynamicPages\Http\Controllers\Admin\DynamicPages\H1Controller::class,
            'model'      => \DynamicPages\Models\Blockables\H1::class,
        ],
        'text'             => [
            'name'       => 'dynamic-pages::names.text',
            'controller' => \DynamicPages\Http\Controllers\Admin\DynamicPages\TextController::class,
            'model'      => \DynamicPages\Models\Blockables\Text::class,
        ],
        'two_columns_text' => [
            'name'       => 'dynamic-pages::names.two_columns_text',
            'controller' => \DynamicPages\Http\Controllers\Admin\DynamicPages\TwoColumnsTextController::class,
            'model'      => \DynamicPages\Models\Blockables\TwoColumnsText::class,
        ],
        'text_image'       => [
            'name'       => 'dynamic-pages::names.text_image',
            'controller' => \DynamicPages\Http\Controllers\Admin\DynamicPages\TextImageController::class,
            'model'      => \DynamicPages\Models\Blockables\TextImage::class,
        ],
        'image_text'       => [
            'name'       => 'dynamic-pages::names.image_text',
            'controller' => \DynamicPages\Http\Controllers\Admin\DynamicPages\TextImageController::class,
            'model'      => \DynamicPages\Models\Blockables\TextImage::class,
        ],
    ],
];
