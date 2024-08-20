<?php

return [
    'novaposhta' => [
        'api_url' => env('NOVAPOSHTA_API_URL', 'https://novaposhta.test/api/delivery'),
        'sender_address' => env('NOVAPOSHTA_SENDER_ADDRESS', 'Your company address here'),
    ],
];
