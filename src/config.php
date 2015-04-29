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
		'templates' => [
			'default' =>'404'],
		'login' => 0
	],
	'home' => [ // The home controller can't receive any parameters.
		'controller' => 'home',
		'templates' => [
			'default' =>'home'],
		'login' => 0
	],
	'signin' => [
		'controller' => 'signin',
		'templates' => [
			'default' =>'signin'],
		'login' => 2
	], 
	'signout' => [
		'controller' => 'signout',
		'templates' => [
			'default' =>'signout'],
		'login' => 1
	],
	'register' => [
		'controller' => 'register',
		'templates' => [
			'default' =>'register'],
		'login' => 2
	],
	'about' => [
		'controller' => 'about',
		'templates' => [
			'default' =>'about'],
		'login' => 0
	],
	'contact' => [
		'controller' => 'contact',
		'templates' => [
			'default' =>'contact'],
		'login' => 0
	],
	'policy' => [
		'controller' => 'policy',
		'templates' => [
			'default' =>'policy'],
		'login' => 0
	],
	'upload' => [
		'controller' => 'upload',
		'templates' => [
			'default' =>'upload'],
		'login' => 1
	],
	'account' => [
		'controller' => 'account',
		'templates' => [
			'default' =>'account'],
		'login' => 1
	],
	'user' => [
		'controller' => 'user',
		'templates' => [
			'default' =>'user'],
		'login' => 0
	],
	'tag' => [
		'controller' => 'tag',
		'templates' => [
			'default' =>'tag'],
		'login' => 0
	],
	'search' => [
		'controller' => 'search',
		'templates' => [
			'default' =>'search'],
		'login' => 0
	],
	'snippet' => [
		'controller' => 'snippets',
		'templates' => [
			'default'=>'snippet', 
			'edit' => 'snippet-edit',
			'delete' => 'snippet-delete',
			'create' => 'snippet-create'],
		'login' => 0
	]
];

?>