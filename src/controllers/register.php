<?php

class Register extends Controller
{
	private $templates = PAGES['register']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
		print_r($_POST['profile_picture']);

		// if(isset($_POST['submit'])){
		// 		if(isset($_POST['username'])){

		// 		}
		// 		else
		// 		{
		// 			$this->data['error.username'] = "Username not filled in.";
		// 		}
		// 			if(isset($_POST['password'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.password'] = "Password not filled in.";
		// 		}
		// 			if(isset($_POST['first_name'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.first_name'] = "First name not filled in.";
		// 		}
		// 			if(isset($_POST['last_name'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.last_name'] = "Last name not filled in.";
		// 		}
		// 			if(isset($_POST['email'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.email'] = "E-mail not filled in.";
		// 		}
		// 			if(isset($_POST['birthday'] && isset($_POST['birthmonth'] && isset($_POST['birthyear'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.birthday'] = "Birthday not filled in.";
		// 		}
		// 			if(isset($_POST['profession'])){

		// 			}
		// 			else
		// 		{
		// 			$this->data['error.profession'] = "Profession not filled in.";
		// 		}
		// 	}
		// 	$this->data['username'] = $_POST['username'];
		// 	$this->data['password'] = $_POST['password'];
		// 	$this->data['first_name'] = $_POST['first_name'];
		// 	$this->data['last_name'] = $_POST['last_name'];
		// 	$this->data['email'] = $_POST['email'];
		// 	$this->data['birthday'] = $_POST['birthday'];
		// 	$this->data['birthmonth'] = $_POST['birthmonth'];
		// 	$this->data['birthyear'] = $_POST['birthyear'];
		// 	$this->data['profession'] = $_POST['profession'];
		// 	isset($_POST['profile_picture'])
		// 	{
		// 		$this->data['profile_picture'] = $_POST['profile_picture'];
		// 	}
		}
	}
}
