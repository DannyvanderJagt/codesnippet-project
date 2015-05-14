<?php

/**
 * The router will get the requested 
 * url parameters (see .htaccess file) 
 * and load the right controller.
 */
class Router{

	private $requestedPage;
	private $requestedParams;

	/**
	 * Get the url parameters, validate the requested 
	 * stuff and load what's requested if everything is valid.
	 */
	public function __construct(){
		// Catche the request.
		$this->parse($_GET);
		// Catch api calls.
		if($this->isApi()){
			return false; 
		}

		// Then validate if the page exists.
		$this->validate();
		// Check for Auth requirements.
		// $this->auth();
		// If everything is oke, load the constructor.
		$this->loadConstructor();
	}

	// Public area.

	/**
	 * Convert the url parameters into a page name and additional requested parameters.
	 * @param  [type] $params [description]
	 * @return [type]         [description]
	 */
	public function parse($params){
		$result;

		if(isset($params['url'])){
			$result = explode('/',filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}else{
			// Default, just to be safe.
			$result = ['home'];
		}

		$this->requestedPage = $result[0];
		$this->requestedParams = array_slice($result, 1);
	}

	/**
	 * Validate the requested page.
	 * Check if the controller exists.
	 * @return [type] [description]
	 */
	public function validate(){
		// Check if the controller exists.
		if(!file_exists('../controller/' . $this->requestedPage .'.php')){
			System::pageNotFound($this->requestedPage);
		}
	}

	/**
	 * Check for an api call, validate and execute it.
	 * @return boolean [description]
	 */
	public function isApi(){
		if(!$this->requestedPage == 'api'){
			return false;
		}

		// Validate the incomming request.
		if(empty($this->requestedParams[0])){
			$this->showApiResult([
				'error'=>404, 
				'errorMessage'=> 'You forgot the enter a class!'
			]);
		}

		$class = $this->requestedParams[0];

		if(empty($this->requestedParams[1])){
			$this->showApiResult([
				'error'=>404, 
				'errorMessage'=> 'You forgot the enter a method!'
			]);
		}

		$method = $this->requestedParams[1];
		$params = array_slice($this->requestedParams, 2);

		// Check if the requested api exists.
		$exist = Api::exist($class);
		
		if(!$exist){
			$this->showApiResult([
				'error'=>404,
				'errorMessage'=>'This api doesn\'t exists'
			]);
		}

		$api = get_class_vars("Api")[$class];
		$sn = Api::$Snippet;
		
		// Check if the method exists.
		if(!method_exists($api, $method)){
			$this->showApiResult([
				'error'=>404,
				'errorMessage'=>'This method within the api doesn\'t exists'
			]);
		}

		// Check if all the right parameters are given.
		// Get all the required parameters.
		$requiredParams = (new ReflectionMethod($api, $method))->getParameters();

		if(!count($requiredParams) == count($params)){
			$this->showApiResult([
				'error'=>404,
				'errorMessage'=>'The number of parameters for this method is wrong!'
			]);
		}

		// Everything is check and oke. Now execute the method.
		$data = call_user_func_array([$api, $method], $params);

		$this->showApiResult([
			'error'=>NULL,
			'errorMessage'=>NULL,
			'data' => $data
		]);

		return true;
	}

	/**
	 * Show the results in json.
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function showApiResult($data){
		echo "<pre>";
		echo System::json_readable_encode($data);
		echo "</pre>";
		exit();
	}

	/**
	 * Check if the user has the right authorization for this requested page.
	 * (Is using cookies)
	 * @return [type] [description]
	 */
	public function auth(){

	}


	/**
	 * If everything is validated then it is time to load the requested controller.
	 * @return [type] [description]
	 */
	public function loadConstructor(){
		require('../controller/' . $this->requestedPage .'.php');

		// Catch some special requests.
		if($this->requestedPage == '404'){
			$this->requestedPage = 'NotFound';
		}

		$controller = new $this->requestedPage();
		$controller->onRequest();
	}

}