<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Package Configuration
    |--------------------------------------------------------------------------
    |
    | This is the configuration for Dagim's LaraCraft package.
    |
    */
    
    'primary_key_type' => 'id',
    'stubs_path' => __DIR__.'/../resources/stubs',
    
    'paths' => [
        'models' => app_path('Models'),
        'controllers' => app_path('Http/Controllers'),
        'requests' => app_path('Http/Requests'),
        'policies' => app_path('Policies'),
        'resources' => app_path('Http/Resources'),
        'migrations' => database_path('migrations'),
        'factories' => database_path('factories'),
        'seeders' => database_path('seeders'),
    ],

    'namespace' => [
        'models' => 'App\Models',
        'controllers' => 'App\Http\Controllers',
        'requests' => 'App\Http\Requests',
        'policies' => 'App\Policies',
        'resources' => 'App\Http\Resources',
    ],
    
    'signature' => [
        'author' => 'Dagim',
        'email' => 'dagim.assefa098@gmail.com',
        'year' => date('Y'),
    ],
];

?>