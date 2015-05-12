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

	protected $data = [];

	public function __construct(){
		$this->loader = new Twig_Loader_Filesystem('../' . PATHS['templates']);
		$this->twig = new Twig_Environment($this->loader, array(
		    // 'cache' => '../cache' 
		));
	}

	public function model($model){
		require_once '../' . PATHS['models'] . '/' . $model . '.php';
		return new $model();
	}

	public function display($template = '', $templateData = []){
		global $Session;
		$loaded = $this->twig->loadTemplate('basic.template.html');

		$data = [
			'template' => $template .'.html',
			'data' => $templateData,
			'session' => $Session->getUser(),
			'meta' => ["css" => ["dist/css/base.css"], "js" => ["dist/js/js.js"]]
		];
		$loaded->display($data);
	}
}