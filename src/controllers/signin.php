<?php

class Signin extends Controller
{
	private $templates = PAGES['signin']['templates'];

	public function load($params = []){
		global $Session;
		// print_r($params);
		// $template = $this->twig->loadTemplate($this->templates[0].'.html');
		// $this->loadTemplate($this->templates[0].'.html');

		if(isset($_POST['submit'])){
			
			if(isset($_POST['username']) && $_POST['password']){
				$result = $Session->login($_POST['username'], $_POST['password']);
				if($result == false){
					$this->data['error'] = 'Your username and/or password is incorrect!';
				}
			}else{
				$this->data['error'] = 'Please fill in your username and password!';
			}
			$this->data['username'] = $_POST['username'];
			$this->data['password'] = $_POST['password'];
		}

		$this->display($this->templates[0].'.html', $this->data);
	}
}
