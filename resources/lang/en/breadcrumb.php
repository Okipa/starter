<?php

return [

    'orphan' => [
        'index' => ':entity > Management',
        'create' => ':entity > Creation',
        'edit' => ':entity > Edition > :detail ',
    ],

    'parent' => [
        'index' => ':parent > :entity > Management',
        'create' => ':parent > :entity > Creation',
        'edit' => ':parent > :entity > Edition > :detail',
    ],

];
