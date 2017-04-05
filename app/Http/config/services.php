<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => Beacon\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
		
	'beacon' => [
			'client_id' => env('ANALYTIC_CLIENT_ID','89b88a5f9eaec9ab9b059a56c51e37413be4e043'),
			'client_secret' => env('ANALYTIC_SECRET_ID', '7e58c94dafd3751f90b0e4b4de871be7e8b7ae44'),
			'redirect' => 'https://connect.onyxbeacon.com/oauth/client',
            'analytics' => 'https://connect.onyxbeacon.com/api/v2/analytics',
            'visits'=> 'https://connect.onyxbeacon.com/api/v2/visits',
            'crud_scope'=>'crud',
            'analytics_scope'=>'analytics'

	],
    'beaconParams'=> [
        'analytics'=>[
            'startDate'=>null,
            'endDate'=> null,
            'location'=>null,
            'types'=>null
        ],
        'visits'=>[
            'startDate'=>null,
            'endDate'=>null,
            'location'=>null
        ]
    ]

];
