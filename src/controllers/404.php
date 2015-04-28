<?php

class NotFound extends Controller
{
	private $templates = PAGES['404']['templates'];

	public function __construct(){
		parent::__construct();
		$this->user = $this->model('user');
	}

	public function load($params = []){
		// print_r($params);
		// $user = $this->user->find(1);
		// print_r($user->First_name);
		// $template = $this->twig->loadTemplate($this->templates[0].'.html');
		$this->user = new User();
		$this->user->find(4)->update(['Session_key', '9879']);
		// $this->user->push();
		print_r($this->user->find(4));

		// global $Session;
		// var_dump($Session->isLoggedin());

		// $data = [
		// 	'username'=> $user->Username,
		// 	'email' => $user->email,
		// 	'createdat' => $user->create_at
		// ];

		// $template->display($data);
	}
}
