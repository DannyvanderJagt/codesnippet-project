<?php
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader, array(
    // 'cache' => './tmp/cache', // FIX THIS!
));

$template = $twig->loadTemplate('user.html');

$params = array(
	'name' => 'Fabien', 
	'friends' => array(
		array('firstname' => 'John', 'lastname' => 'Kwah'),
		array('firstname' => 'Golem', 'lastname' => 'Big'),
		array('firstname' => 'Yors', 'lastname' => 'Emha')
	)
);

$template->display($params);

?>