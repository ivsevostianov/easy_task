<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Hash Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default hash driver that will be used to hash
    | passwords for your application. By default, the bcrypt algorithm is
    | used; however, you remain free to modify this option if you wish.
    |
    | Supported: "bcrypt", "argon", "argon2id"
    |
    */

    'driver' => env('HASH_DRIVER', 'bcrypt'),

    /*
    |--------------------------------------------------------------------------
    | Bcrypt Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Bcrypt algorithm. This will allow you
    | to control the amount of time it takes to hash the given password.
    |
    | The cost factor should be between 4 and 31, with higher values
    | being more secure but taking longer to compute.
    |
    */

    'bcrypt' => [
        'rounds' => env('BCRYPT_ROUNDS', 12), // Increased from default 10 for better security
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options that should be used when
    | passwords are hashed using the Argon algorithm. These will allow you
    | to control the amount of time it takes to hash the given password.
    |
    */

    'argon' => [
        'memory' => env('ARGON_MEMORY', 65536), // 64 MB
        'threads' => env('ARGON_THREADS', 1),
        'time' => env('ARGON_TIME', 4),
    ],

    /*
    |--------------------------------------------------------------------------
    | Argon2ID Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for Argon2ID which is
    | the recommended hashing algorithm for new applications as it provides
    | resistance against both side-channel and GPU-based attacks.
    |
    */

    'argon2id' => [
        'memory' => env('ARGON2ID_MEMORY', 65536), // 64 MB
        'threads' => env('ARGON2ID_THREADS', 1),
        'time' => env('ARGON2ID_TIME', 4),
    ],

];
