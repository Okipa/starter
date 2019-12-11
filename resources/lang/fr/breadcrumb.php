<?php

return [

    'orphan' => [
        'index' => ':entity > Gestion',
        'create' => ':entity > Ajout',
        'edit' => ':entity > Édition > :detail ',
    ],

    'parent' => [
        'index' => ':parent > :entity > Gestion',
        'create' => ':parent > :entity > Ajout',
        'edit' => ':parent > :entity > Édition > :detail',
    ],

];
