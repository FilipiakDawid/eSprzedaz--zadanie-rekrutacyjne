<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pets api config
    |--------------------------------------------------------------------------
    |
    */

    'url' => env('https://petstore.swagger.io/v2/pet'),
    'authorization_header' => 'api_key',
    'authorization_secret' => env('PET_STORE_API_KEY'),

];
