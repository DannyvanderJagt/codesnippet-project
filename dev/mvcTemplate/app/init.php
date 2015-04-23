<?php

// Composer autoloader
require_once '../vendor/autoload.php';
require_once 'database.php';

require_once '../Twig/Autoloader.php';
Twig_Autoloader::register();

require_once 'core/app.php';
require_once 'core/controller.php';
