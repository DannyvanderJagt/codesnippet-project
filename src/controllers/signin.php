<?php

class Signin extends Controller
{
	private $templates = PAGES['signin']['templates'];

	public function load($params = []){
		global $Session;

		if(isset($_POST['submit'])){
			
			if(isset($_POST['username']) && $_POST['password']){
				$passwordMD5 = md5($_POST['password']);
				$passwordSHA1 = sha1($passwordMD5);
				$result = $Session->login($_POST['username'], $passwordSHA1);
				if($result == false){
					$this->data['error'] = 'Your username and/or password is incorrect!';
				}
			}else{
				$this->data['error'] = 'Please fill in your username and password!';
			}
			$this->data['username'] = $_POST['username'];
			$this->data['password'] = $passwordSHA1;
		}

		$this->display($this->templates['default'], $this->data);
	}
}
