<?php

require_once '../' . PATHS['libs'] . '/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * To use a constructor in a controller extended class use: parent::construct();
 */
class Controller
{
	public $twig;

	public function __construct(){
		$loader = new Twig_Loader_Filesystem('../' . PATHS['templates']);
		$this->twig = new Twig_Environment($loader, array(
		    'cache' => '../' . PATHS['cache']
		));
		echo 'controller construct';
	}

	public function model($model){
		require_once '../' . PATHS['models'] . '/' . $model . '.php';
		return new $model();
	}
}