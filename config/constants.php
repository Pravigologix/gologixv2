<?php

define('API', 'api');
define('V1', 'v1');
define('API_V1', API.'/'.V1.'/');

$MSG_TEMPLATES = [
    'Register' => [
       'Please use this OTP-',
       ' -GoLogix'
        // 'Dear User, you are trying to Register your A/c. Your OTP is ',
        // ' DONT SHARE WITH ANYONE'
    ],
    'Login' => [
        'Please use this OTP-',
       ' -GoLogix'
        // 'Dear User, you are trying to Login for  your A/c. Your OTP is ',
        // ' DONT SHARE WITH ANYONE'
	],
	'Update' => [
        'Please use this OTP to change your mobile number-',
       ' -GoLogix'
        // 'Dear User, you are trying to Login for  your A/c. Your OTP is ',
        // ' DONT SHARE WITH ANYONE'
    ]
];

$DEFAULT_ROLES = [
	[
		'name' => 'admin',
		'type' => 'backend'
	],
	[
		'name' => 'vendor',
		'type' => 'backend',
	],
	[
		'name' => 'crm',
		'type' => 'backend'
	],
	[
		'name' => 'customer',
		'type' => 'frontend'
	]
];

return [

	'API_V1'                                     => API_V1,


	'DEFAULT_ROLES'								 => $DEFAULT_ROLES,
	'MSG_TEMPLATES'								 => $MSG_TEMPLATES
];
