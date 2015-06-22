<?php

class Controller_Policy extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'policy.view.html'
		];	 
	
		public function onAuth($params = []){
			// This page is always available!
			return true;
		}

		public function onRequest($params = []){
			$this->renderView();
		}
	// **************************************** //
}
