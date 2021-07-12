<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Le champ :attribute doit être accepté.',
    'active_url' => 'Le champ :attribute n\'est pas une URL valide.',
    'after' => 'Le champ :attribute doit être une date postérieure au :date.',
    'after_or_equal' => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
    'alpha' => 'Le champ :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'Le champ :attribute ne doit contenir que des lettres, des chiffres et des tirets.',
    'alpha_num' => 'Le champ :attribute ne doit contenir que des lettres et des chiffres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'before' => 'Le champ :attribute doit être une date antérieure au :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
    'between' => [
        'numeric' => 'Le champ :attribute doit avoir une valeur comprise entre :min et :max.',
        'file' => 'Le champ :attribute doit peser entre :min et :max kilo-octets.',
        'string' => 'Le champ :attribute doit compter entre :min et :max caractères.',
        'array' => 'Le champ :attribute doit contenir entre :min et :max éléments.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals' => 'Le champ :attribute doit une date égale à :date.',
    'date_format' => 'Le champ :attribute ne respecte pas le format :format.',
    'different' => 'Les champs :attribute et :other doivent être différents.',
    'digits' => 'Le champ :attribute doit compter :digits chiffres.',
    'digits_between' => 'Le champ :attribute doit compter entre :min et :max chiffres.',
    'dimensions' => 'L\'image :attribute ne possède pas les dimensions requises.',
    'distinct' => 'Le champ :attribute possède une valeur dupliquée.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'ends_with' => 'Le champ :attribute doit terminer par l\'une des valeurs suivantes :values.',
    'exists' => 'Le champ :attribute sélectionné est invalide.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt' => [
        'numeric' => 'Le champ :attribute doit être supérieur à :value.',
        'file' => 'Le champ :attribute doit peser plus de :value kilo-octet(s).',
        'string' => 'Le champ :attribute doit compter plus de :value caractère(s).',
        'array' => 'Le champ :attribute doit contenir plus de :value élément(s).',
    ],
    'gte' => [
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
        'file' => 'Le champ :attribute doit peser :value kilo-octet(s) ou plus.',
        'string' => 'Le champ :attribute doit compter :value caractère(s) ou plus.',
        'array' => 'Le champ :attribute doit contenir :value élément(s) ou plus.',
    ],
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'Le champ :attribute est invalide.',
    'in_array' => 'Le champ :attribute n\'est pas présent dans :other.',
    'integer' => 'Le champ :attribute doit être un nombre entier.',
    'ip' => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le champ :attribute doit être un JSON valide.',
    'lt' => [
        'numeric' => 'Le champ :attribute doit être inférieur à :value.',
        'file' => 'Le champ :attribute doit peser moins de :value kilo-octets.',
        'string' => 'Le champ :attribute doit compter moins de :value caractères.',
        'array' => 'Le champ :attribute doit contenir moins de :value éléments.',
    ],
    'lte' => [
        'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
        'file' => 'Le champ :attribute doit peser :value kilo-octets ou moins.',
        'string' => 'Le champ :attribute doit compter :value caractère(s) ou moins.',
        'array' => 'Le champ :attribute ne doit pas contenir plus de :value éléments.',
    ],
    'max' => [
        'numeric' => 'Le champ :attribute ne doit pas être supérieur à :max.',
        'file' => 'Le champ :attribute ne doit pas peser plus lourd que :max kilo-octet(s).',
        'string' => 'Le champ :attribute ne doit pas compter plus de :max caractère(s).',
        'array' => 'Le champ :attribute ne doit pas contenir plus de :max élément(s).',
    ],
    'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'min' => [
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :min.',
        'file' => 'Le champ :attribute doit peser au minimum :min kilo-octet(s).',
        'string' => 'Le champ :attribute doit compter au minimum :min caractère(s).',
        'array' => 'Le champ :attribute doit contenir au minimum :min élément(s).',
    ],
    'multiple_of' => 'Le champ :attribute doit être un multiple de :value.',
    'not_in' => 'Le champ :attribute est invalide.',
    'not_regex' => 'Le format du champ :attribute est invalide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ :attribute doit être transmis.',
    'prohibited' => 'Le champ :attribute est interdit.',
    'prohibited_if' => 'Le champ :attribute est interdit quand :other a pour valeur :value.',
    'prohibited_unless' => 'Le champ :attribute est interdit sauf si :other a pour valeur(s) :values.',
    'phone' => 'Le champ :attribute est un numéro invalide.',
    'regex' => 'Le format du champ :attribute est invalide.',
    'required' => 'Le champ :attribute est obligatoire.',
    'required_if' => 'Le champ :attribute est obligatoire quand :other est égal à :value.',
    'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est présent dans :values.',
    'required_with' => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_with_all' => 'Le champ :attribute est obligatoire quand :values est présent.',
    'required_without' => 'Le champ :attribute est obligatoire quand :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est obligatoire quand aucun de :values n\'est présent.',
    'same' => 'Les champs :attribute et :other doit être identiques.',
    'size' => [
        'numeric' => 'Le champ :attribute doit être égal à :size.',
        'file' => 'Le champ :attribute doit peser :size kilo-octet(s).',
        'string' => 'Le champ :attribute doit compter :size caractère(s).',
        'array' => 'Le champ :attribute doit contenir :size élément(s).',
    ],
    'starts_with' => 'Le champ :attribute doit commencer par l\'une des valeurs suivantes : :values',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone' => 'Le champ :attribute doit être une timezone valide.',
    'unique' => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded' => 'Le fichier :attribute n\'a pas été chargé.',
    'url' => 'Le champ :attribute doit être une URL valide.',
    'uuid' => 'Le champ :attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'id' => 'ID',
        'email' => 'E-mail',
        'password' => 'Mot de passe',
        'password_confirmation' => 'Confirmation mot de passe',
        'new_password' => 'Nouveau mot de passe',
        'new_password_confirmation' => 'Confirmation nouveau mot de passe',
        'current_password' => 'Mot de passe actuel',
        'remember' => 'Se souvenir de moi',
        'first_name' => 'Prénom',
        'last_name' => 'NOM',
        'name' => 'Nom',
        'created_at' => 'Date créa.',
        'updated_at' => 'Date édit.',
        'title' => 'Titre',
        'nav_title' => 'Titre navigation',
        'unique_key' => 'Identifiant unique',
        'slug' => 'Slug',
        'description' => 'Description',
        'active' => 'Activation',
        'logo_squared' => 'Logo carré',
        'phone_number' => 'Téléphone',
        'address' => 'Adresse',
        'zip_code' => 'Code postal',
        'city' => 'Ville',
        'facebook_url' => 'URL Facebook',
        'twitter_url' => 'URL Twitter',
        'instagram_url' => 'URL Instagram',
        'youtube_url' => 'URL Youtube',
        'matomo_url' => 'URL Matomo',
        'matomo_id_site' => 'ID site Matomo',
        'profile_picture' => 'Photo de profil',
        'illustration' => 'Illustration',
        'category_id' => 'Catégorie',
        'category_ids' => 'Catégories',
        'category_title' => 'Catégorie',
        'published_at' => 'Date publication',
        'position' => 'Position',
        'meta_title' => 'Meta Title',
        'meta_description' => 'Meta Description',
        'meta_image' => 'Meta image',
        'thumb' => 'Vignette',
        'media' => 'Média',
        'message' => 'Message',
        'brickable_type' => 'Type brique',
        'text' => 'Texte',
        'text_left' => 'Texte gauche',
        'text_right' => 'Texte droite',
        'image_right' => 'Image droite',
        'invert_order' => 'Inverser ordre',
        'image' => 'Image',
        'label' => 'Label',
        'caption' => 'Légende',
        'full_width' => 'Pleine largeur',
        'code' => 'Code',
        'recovery_code' => 'Code de récupération',
        'required' => 'Obligatoire',
        'enabled_by_default' => 'Activé par défaut',
        'cookies' => 'Cookies',
        'background_color' => 'Couleur de fond',
        'alignment' => 'Alignement',
        'type' => 'Type',
        'style' => 'Style',
    ],

];
