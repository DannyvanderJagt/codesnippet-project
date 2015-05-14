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

	/**
	 * Create an instance of the Twig Library.
	 */
	public function __construct(){
		$this->loader = new Twig_Loader_Filesystem('../views');
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
	protected function renderView($view = 'default'){
		// TODO: Load an other page when the default doesn't exists!
		$loaded = $this->twig->loadTemplate($this->views[$view]);
		$loaded->display([]);
	}
}