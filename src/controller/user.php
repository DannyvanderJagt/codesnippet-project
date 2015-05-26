<?php

class Controller_User extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'user.view.html'
		];	 
	
		public function onAuth($params = []){
			// This page is always available!
			return true;
		}

		public function onRequest($params = []){
			$data = [];
			$data['user'] = User::getByUsername($params[0]);
		
			if(empty($data['user'])){
				$data = [
					"error" => true,
					"errorMessage" => "This user doens\'t exists!"
				];
			}else{
				// Get the snippets of the user.
				$data['snippets'] = Api::$Snippet->getByUserID($data['user']['ID']);
			}
			
			$this->renderView($data);
		}
	// **************************************** //
}
