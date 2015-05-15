<?php

class Signin extends Controller
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
			System::$Auth->signin("Danny", '91ffd2105e0c4be68c4b88caacc25df87739de32');
			$this->renderView();
		}
	// **************************************** //


}
