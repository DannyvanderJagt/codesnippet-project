<?php

/**
 * Page: Notfound / 404
 * This will be loaded when a requested page doens't exists or can't be found.
 */
class NotFound extends Controller
{

	// ***** Default Controller functions ***** //
		public function __construct(){

		}

		public function onAuth($params = []){
			// This page is always available!
			return true;
		}

		public function onRequest($params = []){

		}
	// **************************************** //


}
