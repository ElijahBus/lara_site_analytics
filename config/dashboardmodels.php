<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Namespace of models
    |--------------------------------------------------------------------------
    |
    | This value is the namespace of your models. This value is used by the
    | Dashboard package to locate your application models.
    |
    */
    'user' => 'App\\User',
    'tos' => 'App\\Tos',

    /*
    |--------------------------------------------------------------------------
    | Namespace of laratrust models
    |--------------------------------------------------------------------------
    |
    | This define the namespace of the Role and Permission models
    | that Latrust uses in the application
    |
    */
    'laratrust' => [
        'role' => 'App\\Role',
        'permission' => 'App\\Permission'
    ],


];
