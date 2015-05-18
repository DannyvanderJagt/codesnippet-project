<?php

class Controller_Snippet extends Controller
{

	// ***** Default Controller functions ***** //
		protected $views = [
			'default' => 'snippet.view.html',
			'edit' => 'snippet.edit.view.html',
			'delete' => 'snippet.delete.view.html',
			'add' => 'snippet.add.view.html'
		];
		
		public function onAuth($params = []){
			// This is only avialable when some one is signed in!
			// Otherwise when an user is not signed in send them to the signin page.
			return System::$Auth->required();
		}

		/**
		 * Redirect to the sub pages.
		 * @param  [type] $params [description]
		 * @return [type]         [description]
		 */
		public function onRequest($params = []){
			// Look for post requests!
			if(!isset($params[0])){
				$this->renderView([
					'error' => true,
					'errorMessage' => "This snippet doesn't exists! (no id)"
				]);
			}

			// Call the right action.
			if(!isset($params[1])){
				$this->onShow($params[0]);
			}else{
				switch($params[1]){
					case 'edit': 
						$this->onEdit($params[0]);
						break;
					case 'delete':
						$this->onDelete($params[0]);
						break;
					case 'add':
						$this->onAdd($params[0]);
						break;
					default:
						$this->onShow($params[0]);
				}
			}
		}

		/**
		 * Receive post data.
		 * @param  [type] $params [description]
		 * @param  [type] $data   [description]
		 * @return [type]         [description]
		 */
		public function onPost($params = [], $data = []){
			print_r($params);
			print_r($data);
		}
		
	// ***** Default Controller functions ***** //

		/**
		 * Edit a already existing snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onEdit($id){
			$data = Api::$Snippet->getById($id);
			if(empty($data)){
				$data = [
					'error' => true,
					'errorMessage' => 'This snippet id doesn\'t exists!'
				];
			}
			$this->renderView($data, 'edit');
		}

		/**
		 * Delete a snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onDelete($id){
			$this->renderView([], 'delete');
		}

		/**
		 * Add a new snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onAdd($id){
			$this->renderView([], 'add');
		}

		/**
		 * Show (the data of) a snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onShow($id){
			$data = Api::$Snippet->getById($id);
			if(empty($data)){
				$data = [
					'error' => true,
					'errorMessage' => 'This snippet id doesn\'t exists!'
				];
			}
			$this->renderView($data);
		}
	// **************************************** //
}
