<?php

return [
    'cons_id'    => env('BPJS_CONS_ID', '123456789'), // consumer id
    'secret_key' => env('BPJS_SECRET_KEY', 'secret'),
    'username'   => env('BPJS_USERNAME', 'username'),
    'password'   => env('BPJS_PASSWORD', 'password'),
    'app_code'   => env('BPJS_APP_CODE', '095'), // kode aplikasi
    'app_url'    => env('BPJS_APP_URL', 'https://dvlp.bpjs-kesehatan.go.id:9081/pcare-rest-v3.0/'), // url aplikasi
];
