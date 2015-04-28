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

/*
	Login:
		0 = It doesn't matter.
		1 = You must be logged in!
		2 = You can't be logged in!
 */

const PAGES = [
	'404' => [ // The notfound page.
		'controller' => '404',
		'templates' => ['404'],
		'login' => 0
	],
	'home' => [ // The home controller can't receive any parameters.
		'controller' => 'home',
		'templates' => ['home'],
		'login' => 0
	],
	'signin' => [
		'controller' => 'signin',
		'templates' => ['signin'],
		'login' => 2
	], 
	'signout' => [
		'controller' => 'signout',
		'templates' => ['signout'],
		'login' => 1
	],
	'register' => [
		'controller' => 'register',
		'templates' => ['register'],
		'login' => 2
	],
	'about' => [
		'controller' => 'about',
		'templates' => ['about'],
		'login' => 0
	],
	'contact' => [
		'controller' => 'contact',
		'templates' => ['contact'],
		'login' => 0
	],
	'policy' => [
		'controller' => 'policy',
		'templates' => ['policy'],
		'login' => 0
	],
	'upload' => [
		'controller' => 'upload',
		'templates' => ['upload'],
		'login' => 1
	],
	'account' => [
		'controller' => 'account',
		'templates' => ['account'],
		'login' => 1
	],
	'user' => [
		'controller' => 'user',
		'templates' => ['user'],
		'login' => 0
	],
	'tag' => [
		'controller' => 'tag',
		'templates' => ['tag'],
		'login' => 0
	],
	'search' => [
		'controller' => 'search',
		'templates' => ['search'],
		'login' => 0
	],
	'snippet' => [
		'controller' => 'snippet',
		'templates' => ['snippet'],
		'login' => 0
	]
];

?>