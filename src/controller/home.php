<?php

class Controller_Home extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'home.view.html',
			'signin' => 'signin.view.html'
		];	 
	
		public function onAuth($params = []){
			// This page is always available!
			return true;
		}

		public function onRequest($params = []){
			$data = [];
			$data['snippets'] = Snippet::getLastest();
			$this->renderView($data);
		}
	// **************************************** //


}
