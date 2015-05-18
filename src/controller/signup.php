<?php

class Controller_Signup extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'signup.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is not signed in!
			// Otherwise when an user is signed in send them to the home page.
			return ['home', !System::$Auth->required()];
		}

		public function onRequest($params = []){
			if(isset($_POST['submit'])){
			$this->data['error'] = [];
				if(isset($_POST['username'])){

				}
				else
				{
					$this->data['error']['username'] = "Username not filled in.";
				}
					if(isset($_POST['password'])){
						
					}
					else
				{
					$this->data['error']['password'] = "Password not filled in.";
				}
					if(isset($_POST['first_name'])){

					}
					else
				{
					$this->data['error']['first_name'] = "First name not filled in.";
				}
					if(isset($_POST['last_name'])){

					}
					else
				{
					$this->data['error']['last_name'] = "Last name not filled in.";
				}
					if(isset($_POST['email'])){

					}
					else
				{
					$this->data['error']['email'] = "E-mail not filled in.";
				}
					if(isset($_POST['birthday']) && isset($_POST['birthmonth']) && isset($_POST['birthyear'])){
						
					}
					else
				{
					$this->data['error']['birthday'] = "Birthday not filled in.";
				}
					if(isset($_POST['profession'])){

					}
					else
				{
					$this->data['error']['profession'] = "Profession not filled in.";
				}
			
			
			if (count($this->data['error']) > 0)
			{
			$this->data['username'] = $_POST['username'];
			$this->data['password'] = $_POST['password'];
			$this->data['first_name'] = $_POST['first_name'];
			$this->data['last_name'] = $_POST['last_name'];
			$this->data['email'] = $_POST['email'];
			$this->data['birthday'] = $_POST['birthday'];
			$this->data['birthmonth'] = $_POST['birthmonth'];
			$this->data['birthyear'] = $_POST['birthyear'];
			$this->data['profession'] = $_POST['profession'];
			if(isset($_POST['profile_picture']))
			{
				$this->data['profile_picture'] = $_POST['profile_picture'];
			}
		}
		
		else
		{
			$picture = 'NULL';
			if(isset($_POST['profile_picture']))
				{
				$picture =  $_POST['profile_picture'];
				}
			$date = $_POST['birthyear'] . "-" . $_POST['birthmonth']. "-" . $_POST['birthday'];
			$passwordMD5 = md5($_POST['password']);
			$passwordSHA1 = sha1($passwordMD5);
			print_r($_POST);
			

			Api::$User->create($_POST['username'], $passwordSHA1,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $date, $_POST['profession'], $picture);
		
		}
	}
			$this->renderView();
		
	// **************************************** //

}

}