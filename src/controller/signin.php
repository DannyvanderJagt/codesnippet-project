<?php

class Controller_Signin extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'signin.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is not signed in!
			// Otherwise when an user is signed in send them to the home page.
			return ['home', !System::$Auth->required()];
		}

		public function onRequest($params = []){
			$this->renderView();
		}

		public function onPost($params = [], $data = []){

			// Validate.
			if(empty($data['username'])){
				$this->data['usernameError'] = 'Please enter a username!';
			}
			if(empty($data['password'])){
				$this->data['passwordError'] = 'Please enter a password!';
			} 

			if($data['username'] && $data['password']){
				$result = System::$Auth->signin(
					$data['username'], 
					Auth::encrypt($data['password'])
				);
				if($result){
					System::redirectToHome();
				}else{
					$this->data = [
						'error' => true,
						'errorMessage' => 'Your username and/or password are incorrect!'
					];
				}
			}
			print_r($this->data);
		}
	// **************************************** //


}
