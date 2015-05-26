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
			return true;//['home', !System::$Auth->required()];
		}

		public function onRequest($params = []){
			$data = [];
			$data['query'] = $_GET['q'];
			$data['snippets'] = Snippet::search($_GET['q'], $_GET['l']);
			$this->renderView($data);
		}

		public function onPost($params = [], $data = []){
			
		}
	// **************************************** //


}
