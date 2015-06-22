<?php

class Controller_Howto extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'howto.view.html'
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
