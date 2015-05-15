<?php

class Signin extends Controller
{

	// ***** Default Controller functions ***** //
		public function __construct(){

		}

		public function onAuth($params = []){
			// This is only avialable when some one is not signed in!
			// Otherwise we an user is signed in send them to the home page.
			return ['home', !System::$Auth->required()];
		}

		public function onRequest($params = []){

		}
	// **************************************** //


}
