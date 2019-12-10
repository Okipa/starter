<?php

return [

    'message' => [
        'auth'           => [
            'verificationEmailSent' => 'Un nouveau lien de vérification a été envoyé à l\'adresse :email.',
            'emailVerified'         => 'Votre compte a été vérifié.',
        ],
        'passwords'      => [
            'reset' => 'Votre mot de passe a été réinitialisé.',
            'sent'  => 'Nous vous avons envoyé un e-mail contenant un lien de réinitialisation de mot de passe.',
            'token' => 'Le jeton de réinitialisation du mot de passe est invalide.',
            'user'  => 'Nous ne trouvons pas d\'utilisateur associé à cette adresse e-mail.',
        ],
        'crud'           => [
            'name'   => [
                'created'        => 'L\'entrée « :name » a été créée.',
                'updated'        => 'L\'entrée « :name » a été mise à jour.',
                'destroyConfirm' => 'Êtes-vous sûr de vouloir supprimer l\'entrée « :name » ?',
                'destroyed'      => 'L\'entrée « :name » a été supprimée.',
            ],
            'orphan' => [
                'created'        => 'L\'entrée « :entity > :name » a été créée.',
                'updated'        => 'L\'entrée « :entity > :name » a été mise à jour.',
                'destroyConfirm' => 'Êtes-vous sûr de vouloir supprimer l\'entrée : « :entity > :name » ?',
                'destroyed'      => 'L\'entrée « :entity > :name » a été supprimée.',
            ],
            'parent' => [
                'created'        => 'L\'entrée « :parent > :entity > :name » a été créée.',
                'updated'        => 'L\'entrée « :parent > :entity > :name » a été mise à jour.',
                'destroyConfirm' => 'Êtes-vous sûr de vouloir supprimer l\'entrée : « :parent > :entity > :name » ?',
                'destroyed'      => 'L\'entrée « :parent > :entity > :name » a été supprimée.',
            ],
        ],
        'validation'     => [
            'failed' => 'Des champs invalides ont été détectées.',
        ],
        'exception'      => [
            'support' => 'Une erreur imprévue est survenue. Si le problème persiste, merci de contacter le support.',
        ],
        'profile'        => [
            'updated' => 'Votre profil a été mis à jour.',
        ],
        'downloadFile'   => [
            'doesNotExist' => 'Le fichier :file que vous souhaitez télécharger n\'existe pas. Si le problème persiste, merci de contacter le support.',
        ],
        'reorganization' => [
            'success' => 'La liste a été réorganisée.',
        ],
        'loading'        => 'Merci de patienter quelques instants...',
    ],

];

