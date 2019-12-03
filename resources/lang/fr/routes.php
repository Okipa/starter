<?php
return [
    // content *********************************************************************************************************
    'login'        => [
        'index'  => 'connexion',
        'login'  => 'connecter',
        'logout' => 'deconnecter',
    ],
    'password'     => [
        'index'     => 'mot-de-passe/reinitialisation',
        'email'     => 'mot-de-passe/e-mail',
        'update'    => 'mot-de-passe/reinitialisation/{token}',
        'reset'     => 'mot-de-passe/reinitialiser',
        'confirm'   => 'mot-de-passe/verification',
        'reconfirm' => 'mot-de-passe/confirmer',
    ],
    'registration' => [
        'index'    => 'inscription',
        'register' => 'inscrire',
    ],
    'verification' => [
        'notice' => 'email/verification',
        'verify' => 'email/verification/{id}',
        'resend' => 'email/renvoi',
    ],
    'admin'        => [
        'index' => '/',
    ],
    'dashboard'    => [
        'index' => 'tableau-de-bord',
    ],
    'home'         => [
        'page'   => [
            'index'  => '/',
            'edit'   => 'accueil/page/editer',
            'update' => 'accueil/page/mettre-a-jour',
        ],
        'slides' => [
            'index'   => 'accueil/slides',
            'create'  => 'accueil/slide/creer',
            'store'   => 'accueil/slide/enregistrer',
            'edit'    => 'accueil/slide/editer/{homeSlide}',
            'update'  => 'accueil/slide/mettre-a-jour/{homeSlide}',
            'destroy' => 'accueil/slide/supprimer/{homeSlide}',
        ],
    ],
    'news'         => [
        'categories' => [
            'index'   => 'news/categories',
            'create'  => 'news/categorie/creer',
            'store'   => 'news/categorie/enregistrer',
            'edit'    => 'news/categorie/editer/{category}',
            'update'  => 'news/categorie/mettre-a-jour/{category}',
            'destroy' => 'news/categorie/supprimer/{category}',
        ],
        'articles'   => [
            'index'   => 'news/articles',
            'create'  => 'news/article/creer',
            'store'   => 'news/article/enregistrer',
            'edit'    => 'news/article/editer/{article}',
            'update'  => 'news/article/mettre-a-jour/{article}',
            'destroy' => 'news/article/supprimer/{article}',
            'show'    => 'news/article/{url}',
        ],
    ],
    'contact'      => [
        'page' => [
            'edit'   => 'contact/page/editer',
            'update' => 'contact/page/mettre-a-jour',
            'show'   => 'contact',
        ],
    ],
    'simplePages'  => [
        'show'    => '{url}',
        'index'   => 'pages',
        'create'  => 'page/creer',
        'store'   => 'page/enregistrer',
        'edit'    => 'page/editer/{simplePage}',
        'update'  => 'page/mettre-a-jour/{simplePage}',
        'destroy' => 'page/supprimer/{simplePage}',
    ],
    'libraryMedia' => [
        'categories' => [
            'index'   => 'bibliotheque/media/categories',
            'create'  => 'bibliotheque/media/categorie/creer',
            'store'   => 'bibliotheque/media/categorie/enregistrer',
            'edit'    => 'bibliotheque/media/categorie/editer/{category}',
            'update'  => 'bibliotheque/media/categorie/mettre-a-jour/{category}',
            'destroy' => 'bibliotheque/media/categorie/supprimer/{category}',
        ],
        'files'      => [
            'index'            => 'bibliotheque/media/fichiers',
            'create'           => 'bibliotheque/media/fichier/creer',
            'store'            => 'bibliotheque/media/fichier/enregistrer',
            'edit'             => 'bibliotheque/media/fichier/editer/{file}',
            'update'           => 'bibliotheque/media/fichier/mettre-a-jour/{file}',
            'destroy'          => 'bibliotheque/media/fichier/supprimer/{file}',
            'clipboardContent' => 'bibliotheque/media/fichier/presse-papier/contenu/{file}/{type}',
        ],
    ],
    // admin ***********************************************************************************************************
    'settings'     => [
        'index'  => 'parametres',
        'update' => 'parametres/mettre-a-jour',
    ],
    'users'        => [
        'index'   => 'utilisateurs',
        'create'  => 'utilisateur/creer',
        'store'   => 'utilisateur/enregistrer',
        'edit'    => 'utilisateur/editer/{user}',
        'update'  => 'utilisateur/mettre-a-jour/{user}',
        'destroy' => 'utilisateur/supprimer/{user}',
        'profile' => [
            'edit' => 'mon-profil',
        ],
    ],
];
