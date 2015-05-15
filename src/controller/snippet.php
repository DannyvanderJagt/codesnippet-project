<?php

class Controller_Snippet extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'snippet.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is signed in!
			// Otherwise when an user is not signed in send them to the signin page.
			return System::$Auth->required();
		}

		public function onRequest($params = []){
			print_r($params);
			$this->renderView();
		}
	// **************************************** //
}
