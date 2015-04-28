<?php
// Start the sessions.
session_start();

// Load these before we do anything.
include('config.php');
require_once 'assets/libs/autoload.php';
require_once 'database.php';
require_once 'controller.php';

// The App.
class App
{
	private $homePage = 'home';
	private $notFoundPage = '404';
	private $requestedPage;
	private $params = [];

	// Process the requested url.
	public function __construct(){
		// Get the loggedin user.
		$user = [
			'state'=> 0 // 0 = logged out, 1 = logged in.
		];

		$this->params = $this->parseUrl();

		if(in_array($this->params[0], array_keys(PAGES))){
			$this->requestedPage = PAGES[$this->params[0]];
		}else{
			$this->requestedPage = PAGES[$this->notFoundPage];
		}

		// Check the login required setting of the page.
		if($user['state'] != $this->requestedPage['login'] && $this->requestedPage['login'] == 1){
			// Redirect to the signin page.
			header("Location: signin");
			exit();
		}

		if($user['state'] != $this->requestedPage['login'] && $this->requestedPage['login'] == 2){
			// Redirect to the home page.
			header("Location: home");
			exit();
		}

		// Catch the 404 page.
		if($this->requestedPage['controller'] == '404'){
			$this->redirect404();
			return false;
		}

		// Check if the controller exists.
		if(!$this->controllerExists()){
			$this->redirect404();
			return false;
		}

		// Check if the template files exists.
		if(!$this->templatesExists()){
			$this->redirect404();
			return false;
		}

		// Unset.
		unset($this->params[0]);
		
		// Load the controller.
		require_once '../' . PATHS['controllers'] . '/' . $this->requestedPage['controller'] . '.php';
		$this->controller = new $this->requestedPage['controller']();

		// If there are parameters left send then to the controller.
		$this->params = isset($this->params) ? array_values($this->params) : [];
			
		// Call the load function of the page controller.
		call_user_func_array([$this->controller, 'load'], [$this->params]);
	}

	/**
	 * When a page can't be found redirect then to the 404 page.
	 * @return [type] [description]
	 */
	private function redirect404(){
		echo "Load 404!";
		// Load the 404 controller.
		require_once '../' . PATHS['controllers'] . '/404.php';
		$this->controller = 'NotFound';
		$this->controller = new $this->controller();
		call_user_func_array([$this->controller, 'load'], []);
	}

	/**
	 * Check if the file for the controller exists.
	 * @return [type] [description]
	 */
	private function controllerExists(){
		$errors = [];
		// Check if the controller exists.
		if(!file_exists('../' . PATHS['controllers'] . '/' . $this->requestedPage['controller'] . '.php')){
			// The file doesn't exists!	
			$errors[] = 'The controller doens\'t exists!';
		}

		if(count($errors) == 0){
			return true;
		}
		return false;
	}

	/**
	 * Check if all the template files exists.
	 * @return [type] [description]
	 */
	private function templatesExists(){
		$errors = [];
		foreach($this->requestedPage['templates'] as $template){
			if(!file_exists('../' . PATHS['templates'] . '/' . $template . '.html')){
				$errors[] = 'The template '. $template . ' doens\'t exists!';
			}
		}

		if(count($errors) == 0){
			return true;
		}
		return false;
	}

	
	/**
	 * Convert the string url to an array.
	 * @return [type] [description]
	 */
	private function parseUrl(){
		if(isset($_GET['url'])){
			return explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}

		// Return the homepage!
		return [$this->homePage];
	}
}

// Create a new app to start this thing!
$app = new App();

?>