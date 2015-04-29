<?php

class Signin extends Controller
{
	private $templates = PAGES['signin']['templates'];

	public function load($params = []){
		global $Session;

		if(isset($_POST['submit'])){
			
			if(isset($_POST['username']) && $_POST['password']){
				$_POST['password'] = md5($_POST['password']);
				$_POST['password'] = sha1($_POST)['password'];
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

		$this->display($this->templates['default'], $this->data);
	}
}
