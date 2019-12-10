<?php

return [
    'blocks' => [
        'h1'        => [
            'name'       => 'dynamic-pages.names.h1',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\H1Controller::class,
            'model'      => \App\Models\DynamicPages\H1::class,
        ],
        'paragraph' => [
            'name'       => 'dynamic-pages.names.paragraph',
            'controller' => \App\Http\Controllers\Admin\DynamicPages\ParagraphController::class,
            'model'      => \App\Models\DynamicPages\Paragraph::class,
        ],
    ],
];
