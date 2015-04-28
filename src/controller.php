<?php

require_once '../' . PATHS['libs'] . '/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * To use a constructor in a controller extended class use: parent::__construct();
 */
class Controller
{
	public $twig;
	public $loader;

	public function __construct(){
		$this->loader = new Twig_Loader_Filesystem('../' . PATHS['templates']);
		$this->twig = new Twig_Environment($this->loader, array(
		    'cache' => '../cache' 
		));
	}

	public function model($model){
		require_once '../' . PATHS['models'] . '/' . $model . '.php';
		return new $model();
	}
}