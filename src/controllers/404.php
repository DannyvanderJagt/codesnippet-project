<?php

class NotFound extends Controller
{
	private $templates = PAGES['404']['templates'];

	public function __construct(){
		parent::__construct();
		$this->user = $this->model('user');
	}

	public function load($params = []){
		print_r($params);
		$user = $this->user->find(1);
		print_r($user->First_name);
		// $template = $this->twig->loadTemplate($this->templates[0].'.html');
	
		// $data = [
		// 	'username'=> $user->Username,
		// 	'email' => $user->email,
		// 	'createdat' => $user->create_at
		// ];

		// $template->display($data);
	}
}
