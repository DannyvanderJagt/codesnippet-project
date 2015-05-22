<?php

class Controller_Jobs extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'jobs.view.html'
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
