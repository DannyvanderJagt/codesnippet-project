<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Create a new Capsule from the Laravel Database library.
$capsule = new Capsule();

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => $_SERVER['SERVER_NAME'] == 'localhost' ? '94.213.72.122' : 'localhost', // Ease of use for the server and for local use.
	'username' => 'root',
	'password' => 'Welkom2015',
	'database' => 'codesnippet',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => ''
]);

// Start the database connection.
$capsule->bootEloquent();
$capsule->setAsGlobal();