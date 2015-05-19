<?php

class Controller_Account extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'account.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is signed in!
			// Otherwise when an user is not signed in send them to the signin page.
			if(!isset($params[1])){
				return true;
			}else{
				return System::$Auth->required();
			}
		}

		/**
		 * Redirect to the sub pages.
		 * @param  [type] $params [description]
		 * @return [type]         [description]
		 */
		public function onRequest($params = []){
			$id = System::$Auth->getUser()['ID'];
			$data = User::getById($id);
			$this->renderView($data);
		}

		/**
		 * Receive post data.
		 * @param  [type] $params [description]
		 * @param  [type] $data   [description]
		 * @return [type]         [description]
		 */
		public function onPost($params = [], $data = []){
			User::update(System::$Auth->getUser()['ID'], $data);
		}

	// ***** Default Controller functions ***** //
}
