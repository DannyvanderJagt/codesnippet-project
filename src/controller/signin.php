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
	// **************************************** //


}
