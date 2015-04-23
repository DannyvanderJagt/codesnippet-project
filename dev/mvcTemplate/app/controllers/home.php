<?php

class Home extends Controller
{
	// protected $user;
	private $twig;

	public function __construct(){
		$this->user = $this->model('User');

		$loader = new Twig_Loader_Filesystem('../app/views/home');
		$this->twig = new Twig_Environment($loader, array(
		    // 'cache' => '../cache'
		));
	}

	public function index($name = ''){
		$user = $this->user;
		$user->name = $name;

		$template = $this->twig->loadTemplate('index.php');

		$params = array(
			'name' => 'name'.$user->name
		);

		$template->display($params);
	}

	public function codesnippet($id = ''){

		$result = $this->user->find($id);

		

		$template = $this->twig->loadTemplate('index.php');

		$params = array(
			'username' => $result->username,
			'email' => $result->email,
			'created_at' => $result->create_at
		);

		$template->display($params);
	}


	public function create($username = '', $email = ''){
		$this->user->create([
			'username' => $username,
			'email'=> $email
		]);
	}

}