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
            'index'            => 'page-dynamique-blocs',
            'store'            => 'page-dynamique/{dynamicPage}/bloc/creer',
            'edit'             => 'page-dynamique/{dynamicPage}/bloc/editer/{dynamicPageBlock}',
            'destroy'          => 'page-dynamique/{dynamicPage}/block/supprimer/{dynamicPageBlock}',
            'h1'               => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/h1',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/h1',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/h1/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/h1/{dynamicPageBlock}',
            ],
            'text'             => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/texte',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/texte',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/texte/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/texte/{dynamicPageBlock}',
            ],
            'two_columns_text' => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/texte-2-colonnes',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/texte-2-colonnes',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/texte-2-colonnes/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/texte-2-colonnes/{dynamicPageBlock}',
            ],
            'text_image'       => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/texte-image',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/texte-image',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/texte-image/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/texte-image/{dynamicPageBlock}',
            ],
        ],
    ],
    'entities'   => [
        'dynamicPages'      => 'Pages dynamiques',
        'dynamicPageBlocks' => 'Bloc de page dynamique',
    ],
    'nav'        => [
        'dynamicPages' => 'Pages dynamiques',
    ],
    'section'    => [
        'block' => 'Blocs',
    ],
    'validation' => [
        'attributes' => [
            'block_id'  => 'Bloc',
            'h1'                    => [
                'content' => 'Contenu',
            ],
            'text'             => [
                'content' => 'Contenu',
            ],
            'two_columns_text' => [
                'content_left'  => 'Contenu de gauche',
                'content_right' => 'Contenu de droite',
            ],
            'text_image'       => [
                'content' => 'Contenu',
                'image'   => 'Image',
            ],
        ],
    ],
    'names'      => [
        'h1'                    => 'En-tête 1',
        'text'             => 'Texte',
        'two_columns_text' => 'Texte 2 colonnes',
        'image_text'       => 'Image à gauche, texte à droite',
        'text_image'       => 'Texte à gauche, image à droite',
    ],
];
