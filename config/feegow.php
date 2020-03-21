<?php

return [
    'api' => [
        'url' => env('FEEGOW_API_URL', 'https://api.feegow.com.br/api/'),
        'token' => env('FEEGOW_API_TOKEN', ''),
    ],
    'endpoints' => [
        'specialties' => 'specialties/list',
        'professionals' => 'professional/list',
        'howknow' => 'patient/list-sources',
    ],
];