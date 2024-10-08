<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Prefix URI
    |--------------------------------------------------------------------------
    |
    | This URI is used to prefix all GDPR routes. You may change this value as
    | required, but don't forget the update your forms accordingly.
    |
    */

    'uri' => 'gdpr',

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware are run during every request to the GDPR routes. Please
    | keep in mind to only allow authenticated users to access the routes.
    |
    */

    'middleware' => [
        'web',
        'sentinel.auth',
    ],

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | This setting specifies the Time To Live in months, before the specified model
    | is anonymized automatically.
    |
    */

    'settings' => [
        'ttl' => 36,
        'user_model_fqn' => \LANMS\User::class, // Fully qualified namespace of the User model
    ],

    /*
    |--------------------------------------------------------------------------
    | String
    |--------------------------------------------------------------------------
    |
    | This is the default string the anonymized fields will change to.
    |
    |
    */

    'string' => [
        'default' => 'Anonymized',
    ],

];
