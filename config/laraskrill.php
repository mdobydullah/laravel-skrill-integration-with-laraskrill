<?php
/**
 * LaraSkrill Configuration
 * Author: Md. Obydullah <obydul@makpie.com>.
 * Author URL: https://obydul.me
 */

return [
    'merchant_email' => 'demoqco@sun-fish.com',
    'api_password' => 'MD5 API/MQI password', // required for refund option only.
    'return_url' => 'https://laravel.dev/payment-completed',
    'cancel_url' => 'https://laravel.dev/payment-cancelled',
    'status_url' => 'obydulcse@gmail.com', // url or email
//    'status_url' => 'http://laravel.dev/ipn', // url or email
    'status_url2' => 'mdobydullahcse@gmail.com', // url or email
    'refund_status_url' => 'IPN URL or Email', // url or email
    'logo_url' => 'https://i.imgur.com/BYBiIZX.png',
];
