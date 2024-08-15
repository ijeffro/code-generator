<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Access Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'allocated' => "Successfully allocated :code.",
    'unallocated' => "Successfully unallocated :code.",
    'count' => "There are :count unalocated codes.",
    'missing' => "Code :code Not found.",
    'length' => "Code :code Not found.",
    'completed' => 'Successfully created :code.',

    'setup' => [
        'start' => '',
        'failed' => '',
        'completed' => '',
        'questions' => [
            'config' => 'Publish the config file to your application?',
            'routes' => 'Publish the database routesto your application?',
            'models' => 'Publish the modelsto your application?',
            'migrations' => 'Publish the database migrationsto your application?',
            'translations' => 'Publish the language translationsto your application?',
        ]

    ],
    'create' => [
        'batch' => []
    ],

    'digits' => 'Number of digits must be greater than zero.',
];
