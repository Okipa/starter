<?php

return [

    'notification' => [
        'greeting' => [
            'default' => 'Bonjour !',
            'named' => 'Bonjour :name !',
            'error' => 'Whoops !',
        ],
        'action' => [
            'alternative' => 'Si vous ne parvenez pas à cliquer sur le bouton « :actionText », effectuez un copier/coller du lien ci-dessous dans votre navigateur : :actionURL',
            'contact' => 'Nous contacter',
            'phone' => '[:phoneNumber](tel::phoneNumber)',
            'email' => '[:email](mailto::email)',
        ],
        'salutation' => [
            'default' => 'Bien à vous',
        ],
        'signature' => 'L\'équipe **:team**',
    ],

    'ResetPassword' => [
        'subject' => 'Réinitialisez votre mot de passe',
        'message' => 'Cet email vous a été envoyé car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.',
        'action' => 'Réinitialiser le mot de passe',
        'notice' => 'Si vous n\'avez pas effectué de demande de réinitialisation du mot de passe, aucune action de votre part n\'est nécessaire.',
    ],

    'emailVerification' => [
        'subject' => 'Confirmez votre adresse email',
        'message' => 'Pour confirmer votre adresse email, veuillez cliquer sur le bouton ci-dessous.',
        'action' => 'Confirmer mon adresse email',
        'notice' => 'Si vous n\'avez pas créé de compte, aucune action de votre part n\'est nécessaire.',
    ],

    'InitializePassword' => [
        'subject' => 'Créez votre mot de passe sécurisé',
        'message' => 'Bienvenue sur la plateforme :app. Votre compte a été créé et pour vous y connecter, il vous faut maintenant créer votre mot de passe sécurisé.',
        'action' => 'Créer mon mot de passe sécurisé',
        'expiration' => 'Ce lien expirera dans :minutes minutes.',
        'notice' => 'Si vous n\'avez pas réalisé de demande de création de compte, aucune action de votre part n\'est nécessaire.',
    ],

    'ContactFormMessage' => [
        'subject' => [
            'original' => 'Formulaire de contact : nouveau message',
            'copy' => 'Formulaire de contact : copie de votre message',
        ],
        'message' => [
            'original' => 'Ce message vous a été adressé depuis le formulaire de contact de :app.',
            'copy' => 'Nous vous adressons une copie du message que vous avez envoyé depuis le formulaire de contact de :app.',
        ],
    ],
];
