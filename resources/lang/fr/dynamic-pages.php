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
            'index'   => 'page-dynamique-blocs',
            'store'   => 'page-dynamique/{dynamicPage}/bloc/creer',
            'edit'    => 'page-dynamique/{dynamicPage}/bloc/editer/{dynamicPageBlock}',
            'destroy' => 'page-dynamique/{dynamicPage}/block/supprimer/{dynamicPageBlock}',
            'h1'                    => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/h1',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/h1',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/h1/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/h1/{dynamicPageBlock}',
            ],
            'paragraph'             => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/paragraphe',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/paragraphe',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/paragraphe/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/paragraphe/{dynamicPageBlock}',
            ],
            'two_columns_paragraph' => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/paragraphe-2-colonnes',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/paragraphe-2-colonnes',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/paragraphe-2-colonnes/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/paragraphe-2-colonnes/{dynamicPageBlock}',
            ],
            'paragraph_image'       => [
                'create' => 'page-dynamique/{dynamicPage}/bloc/creer/paragraphe-image',
                'store'  => 'page-dynamique/{dynamicPage}/bloc/enregistrer/paragraphe-image',
                'edit'   => 'page-dynamique/{dynamicPage}/bloc/editer/paragraphe-image/{dynamicPageBlock}',
                'update' => 'page-dynamique/{dynamicPage}/bloc/mettre-a-jour/paragraphe-image/{dynamicPageBlock}',
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
            'paragraph'             => [
                'content' => 'Contenu',
            ],
            'two_columns_paragraph' => [
                'content_left'  => 'Contenu de gauche',
                'content_right' => 'Contenu de droite',
            ],
            'paragraph_image'       => [
                'content' => 'Contenu',
                'image'   => 'Image',
            ],
        ],
    ],
    'names'      => [
        'h1'                    => 'En-tête 1',
        'paragraph'             => 'Paragraphe',
        'two_columns_paragraph' => 'Paragraphe 2 colonnes',
        'image_paragraph'       => 'Image à gauche, paragraphe à droite',
        'paragraph_image'       => 'Paragraphe à gauche, image à droite',
    ],
];
