<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Login Throttling Configuration
    |--------------------------------------------------------------------------
    |
    | These settings control the rate limiting for login attempts.
    | You can adjust these values to make the throttling more or less strict.
    |
    */

    'login_throttling' => [
        // Maximum number of login attempts before throttling kicks in
        'max_attempts' => env('LOGIN_THROTTLE_MAX_ATTEMPTS', 5),

        // Throttling duration in minutes after max attempts are reached
        'decay_minutes' => env('LOGIN_THROTTLE_DECAY_MINUTES', 1),

        // Lockout duration in seconds when throttled
        'lockout_duration' => env('LOGIN_THROTTLE_LOCKOUT_DURATION', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Security Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for password security requirements and policies.
    |
    */

    'passwords' => [
        // Minimum password length
        'min_length' => env('PASSWORD_MIN_LENGTH', 12),

        // Require mixed case letters
        'require_mixed_case' => env('PASSWORD_REQUIRE_MIXED_CASE', true),

        // Require numbers
        'require_numbers' => env('PASSWORD_REQUIRE_NUMBERS', true),

        // Require symbols
        'require_symbols' => env('PASSWORD_REQUIRE_SYMBOLS', true),

        // Check against compromised password databases
        'check_compromised' => env('PASSWORD_CHECK_COMPROMISED', true),
    ],
];
