<?php

const PATHS = array(
	'libs' => 'assets/libs',
	'controllers' => 'controllers',
	'templates' => 'templates',
	'models' => 'models',
	'cache' => 'cache'
);

const MODELS = [
	'user',
	'snippet',
	'comment',
	'session'
];

const PAGES = [
	'404' => [ // The notfound page.
		'controller' => '404',
		'templates' => ['404']
	],
	'home' => [ // The home controller can't receive any parameters.
		'controller' => 'home',
		'templates' => ['home']
	],
	'signin' => [
		'controller' => 'signin',
		'templates' => ['signin']
	], 
	'signout' => [
		'controller' => 'signout',
		'templates' => ['signout']
	],
	'register' => [
		'controller' => 'register',
		'templates' => ['register']
	],

	'about' => [
		'controller' => 'about',
		'templates' => ['about']
	],
	'contact' => [
		'controller' => 'contact',
		'templates' => ['contact']
	],
	'policy' => [
		'controller' => 'policy',
		'templates' => ['policy']
	],

	'upload' => [
		'controller' => 'upload',
		'templates' => ['upload']
	],
	'account' => [
		'controller' => 'account',
		'templates' => ['account']
	],
	'user' => [
		'controller' => 'user',
		'templates' => ['user']
	],
	'tag' => [
		'controller' => 'tag',
		'templates' => ['tag']
	],
	'search' => [
		'controller' => 'search',
		'templates' => ['search']
	],
	'snippet' => [
		'controller' => 'snippet',
		'templates' => ['snippet']
	]
];

?>