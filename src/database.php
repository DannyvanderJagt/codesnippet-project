<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
	'driver' => 'mysql',
	// 'host' => 'localhost',
	// 'username' => 'root',
	// 'password' => '',
	// 'database' => 'website',
	'host' => $_SERVER['SERVER_NAME'] == 'localhost' ? '94.213.72.122' : 'localhost',
	'username' => 'root',
	'password' => 'Welkom2015',
	'database' => 'codesnippet',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => ''
]);

$capsule->bootEloquent();
$capsule->setAsGlobal();