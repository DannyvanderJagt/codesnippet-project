<?php

class Controller_About extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'about.view.html'
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
