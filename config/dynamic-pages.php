<?php

return [
    'blocks' => [
        'h1'                    => [
            'name'       => 'dynamic-pages.names.h1',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\H1Controller::class,
            'model'      => \App\Models\DynamicPages\H1::class,
        ],
        'paragraph'             => [
            'name'       => 'dynamic-pages.names.paragraph',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\ParagraphController::class,
            'model'      => \App\Models\DynamicPages\Paragraph::class,
        ],
        'two_columns_paragraph' => [
            'name'       => 'dynamic-pages.names.two_columns_paragraph',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\TwoColumnsParagraphController::class,
            'model'      => \App\Models\DynamicPages\TwoColumnsParagraph::class,
        ],
        'paragraph_image'       => [
            'name'       => 'dynamic-pages.names.paragraph_image',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\ParagraphImageController::class,
            'model'      => \App\Models\DynamicPages\ParagraphImage::class,
        ],
        'image_paragraph'       => [
            'name'       => 'dynamic-pages.names.image_paragraph',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\ParagraphImageController::class,
            'model'      => \App\Models\DynamicPages\ParagraphImage::class,
        ],
    ],
];
