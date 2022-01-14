<?php

return [
    'google' => [
        'client_id' => env('OAUTH_GOOGLE_CLIENT_ID'),
        'secret_key' => env('OAUTH_GOOGLE_SECRET_KEY'),
        'call_back' => env('OAUTH_GOOGLE_CALLBACK_URL')
    ]
];
