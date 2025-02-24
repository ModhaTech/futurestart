<?php

// test | live

// $mode = 'test';
// if ($mode === 'test') {
	// return [

	// 	'stripe_key'	=>	env('STRIPE_KEY_TEST'),

	// 	'stripe_pk_key'	=>	env('STRIPE_KEY_PK_TEST'),

	// 	'stripe_connect'	=>	env('STRIPE_CONNECT_TEST'),

	// ];
// }
// else if($mode === 'live'){
// return [

// 		'stripe_key'	=>	env('STRIPE_KEY_TEST'),

// 		'stripe_pk_key'	=>	env('STRIPE_KEY_PK_TEST'),

// 		'stripe_connect'	=>	env('STRIPE_CONNECT_TEST'),

// 	];
	// return [

	// 	'stripe_key'	=>	env('STRIPE_KEY_LIVE'),

	// 	'stripe_pk_key'	=>	env('STRIPE_KEY_PK_LIVE'),

	// 	'stripe_connect'	=>	env('STRIPE_CONNECT_LIVE'),

	// ];
// }
// $mode = env('APP_ENV') === 'local' ? 'test' : 'live';

// // Return configuration based on the mode
// return [
//     'stripe_key' => $mode === 'test' ? env('STRIPE_KEY_TEST') : env('STRIPE_KEY_LIVE'),
//     'stripe_pk_key' => $mode === 'test' ? env('STRIPE_KEY_PK_TEST') : env('STRIPE_KEY_PK_LIVE'),
//     'stripe_connect' => $mode === 'test' ? env('STRIPE_CONNECT_TEST') : env('STRIPE_CONNECT_LIVE'),
// ];

return [

    'stripe_key'       => env('STRIPE_KEY_LIVE', 'sk_live_1SrQHEEtaL5AoCdXh01g9Hlk00tahEU3g3'),
    'stripe_pk_key'    => env('STRIPE_KEY_PK_LIVE', 'pk_live_fL133i5MGBg8hhyVsllSepB600T5hUVUmL'),
    'stripe_connect'   => env('STRIPE_CONNECT_LIVE', 'https://dashboard.stripe.com/express/oauth/authorize?response_type=code&client_id=ca_F6ShA9nmj7rFyWAacUK5jHM002arTCh9&scope=read_write'),

];
