<?php

class Config{

	public static $paths = [
		'libs' => 'assets/libs',
		'cache' => 'cache'
	];

	public static $api = [
		'snippet',
		'comment',
		'user',
		'vote'
	];

	public static $loginRequired = [
		'snippet/create',
		'snippet/edit',
		'snippet/delete',
		'account'
	];
}

?>