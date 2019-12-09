<?php

return [
    'blocks' => [
        'two_columns_text' => [
            'name'             => 'dynamic-pages.names.two_columns_text',
            'admin_controller' => \App\Http\Controllers\Admin\DynamicPages\TwoColumnsTextController::class,
            'model'            => \App\Models\DynamicPages\TwoColumnsText::class,
        ],
    ],
];
