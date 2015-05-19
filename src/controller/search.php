<?php

class Controller_Search extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'search.view.html'
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
			
		}
	// **************************************** //


}
