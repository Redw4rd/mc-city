<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */
 
return [
    'mode'    => 'live', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => '',
        'password'    => '',
        'secret'      => '',
        'certificate' => base_path('resources/assets/cacert.pem'),
        'app_id'      => '',    // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => '',
        'password'    => '',
        'secret'      => '',
        'certificate' => '',
        'app_id'      => '',         // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency'       => 'HUF',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
];
