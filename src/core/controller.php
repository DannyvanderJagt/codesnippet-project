<?php

// TODO: 1

// Load the Twig library.
require_once '../assets/libs/twig/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * The Controller class is used to extend the controllers of a page.
 * This class will provide basic functionality for every controller.
 */
class Controller {
	
	protected $data = [];
	protected $views = [];

	/**
	 * Create an instance of the Twig Library.
	 */
	public function __construct(){
		$this->loader = new Twig_Loader_Filesystem(array('../views', '../snippets'));
		$this->twig = new Twig_Environment($this->loader, array(
			// Disable the cache for development!
		    // 'cache' => '../cache' 
		));
	}

	/**
	 * Render the template for this controller.
	 * The default page is 'default'!
	 * @param  string $view [description]
	 * @return [type]       [description]
	 */
	protected function renderView($data = [], $view = 'default'){
		// TODO: Load an other page when the default doesn't exists!
		$loaded = $this->twig->loadTemplate('layout.snippet.html');

		// Collect and combine all the data before sending it to the template.
		$data = [
			'data' => $data,
			'view' => $this->views[$view], 
			'basePath' => System::$baseUrl,
			'auth' => System::$Auth->getUser(),
			'meta' => [
				'js' => [],
				'css' => [System::$baseUrl . '/dist/css/base.css']
			]
		];

		$loaded->display($data);
	}
}