<?php

return [
	'ldap_host' => env('LDAP_HOST', 'localhost'),
	'ldap_user' => env('LDAP_USER'),
	'ldap_pass' => env('LDAP_PASS'),
	'ldap_port' => intval(env('LDAP_PORT', 389)),
];