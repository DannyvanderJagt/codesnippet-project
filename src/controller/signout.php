<?php

class Signout extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'signout.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is signed in!
			// Otherwise when an user is not signed in send them to the signin page.
			return ['signin', System::$Auth->required()];
		}

		public function onRequest($params = []){
			$username = System::$Auth->getUser()['Username'];
			System::$Auth->signout();
			$this->renderView(['Username'=>$username]);
		}
	// **************************************** //


}
