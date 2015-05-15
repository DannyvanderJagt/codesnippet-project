<?php

/**
 * Page: Notfound / 404
 * This will be loaded when a requested page doens't exists or can't be found.
 */
class Controller_NotFound extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => '404.view.html'
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
