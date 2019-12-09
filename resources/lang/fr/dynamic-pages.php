<?php

return [
    'routes'     => [
        'dynamicPages'      => [
            'show'    => 'pages-dynamiques/{url?}',
            'index'   => 'pages-dynamiques',
            'create'  => 'page-dynamique/creer',
            'store'   => 'page-dynamique/enregistrer',
            'edit'    => 'page-dynamique/editer/{dynamicPage}',
            'update'  => 'page-dynamique/mettre-a-jour/{dynamicPage}',
            'destroy' => 'page-dynamique/supprimer/{dynamicPage}',
        ],
        'dynamicPageBlocks' => [
            'store' => 'page-dynamique/{dynamicPage}/bloc/enregistrer',
        ],
    ],
    'entities'   => [
        'dynamicPages' => 'Pages dynamiques',
    ],
    'nav'        => [
        'dynamicPages' => 'Pages dynamiques',
    ],
    'section'    => [
        'block' => 'Blocs',
    ],
    'validation' => [
        'attributes' => [
            'block' => 'Bloc',
        ],
    ],
    'names'      => [
        'two_columns_text' => '2 colonnes de texte',
    ],
];
