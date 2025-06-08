<?php

return [
    'limits' => [
        'max_adults' => env('APPOINTMENT_MAX_ADULTS', 10),
        'max_children' => env('APPOINTMENT_MAX_CHILDREN', 8),
        'max_hours_per_day' => env('APPOINTMENT_MAX_HOURS_PER_DAY', 8),
    ],
    
    'email' => [
        'admin_email' => env('APPOINTMENT_ADMIN_EMAIL', env('MAIL_FROM_ADDRESS', 'admin@example.com')),
        'reply_time_hours' => env('APPOINTMENT_REPLY_TIME_HOURS', 24),
    ],
    
    'validation' => [
        'min_date' => 1, // minimum days from today
        'max_date' => 365, // maximum days from today
    ],
];