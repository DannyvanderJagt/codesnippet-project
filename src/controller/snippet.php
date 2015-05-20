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
			// Look for post requests!
			if(!isset($params[0])){
				$this->renderView([
					'error' => true,
					'errorMessage' => "This snippet doesn't exists! (no id)"
				]);
			}else if($params[0] == 'add'){
				$this->onAdd();
			}else if(!isset($params[1])){
				$this->onShow($params[0]);
			}else{
				switch($params[1]){
					case 'edit': 
						$this->onEdit($params[0]);
						break;
					case 'delete':
						$this->onDelete($params[0]);
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
			if(isset($params[0]) && isset($params[1]) && $params[1] == 'edit'){
				$this->onEditPost($params[0], $data);
			}else if(isset($params[0]) && $params[0] == 'add'){
				$this->onAddPost($data);
			}else if(isset($params[0])){
				// Add comments.
				$this->onAddComment($params[0], $data);
			}
		}

	// ***** Default Controller functions ***** //

		public function onAddComment($snippetID, $data){
			$snippet = Api::$Snippet->getById($snippetID);
			if(empty($snippet)){
				$this->data = [
					'error' => true,
					'errorMessage' => 'This snippet id doesn\'t exists!'
				];
			}
			if(!isset($data['topCommentID'])){
				$data['topCommentID'] = null;
			}
			Api::$Comment->addBySnippetID($snippetID, $data['comment'], $data['topCommentID']);

			return true;
		}


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

		public function upVoteSnippet($snippet){
			$id = $snippet;
			$vote = 1; 
			$voteUser = $userAuth::getUser()['ID']; 
			$user = 'NULL';
			Api::$Vote->voteSnippet($id, $vote, $voteUser, $user);
		}

		public function downVoteSnippet($snippet){
			$id = $snippet;
			$vote = 1; 
			$voteUser = $userAuth::getUser()['ID']; 
			$user = 'NULL';
			Api::$Vote->voteSnippet($id, $vote, $voteUser, $user);
		}

			public function upVoteComment($comment){
			$id = $comment;
			$vote = 1; 
			$voteUser = $userAuth::getUser()['ID']; 
			$user = 'NULL';
			Api::$Vote->voteComment($id, $vote, $voteUser, $user);
		}

		public function downVoteComment($comment){
			$id = $comment;
			$vote = 1; 
			$voteUser = $userAuth::getUser()['ID']; 
			$user = 'NULL';
			Api::$Vote->voteComment($id, $vote, $voteUser, $user);
		}

		public function onEditPost($id, $data){
			// Filter the data.
			$data = [
				'Title' => $data['title'],
				'Code' => $data['code'],
				'Description' => $data['description'],
				'Lang' => $data['lang'],
				'Framework' => $data['framework']
			];

			Api::$Snippet->updateById($id, $data);
		}

		/**
		 * Delete a snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onDelete($id){
			Api::$Snippet->deleteById($id);
			$this->renderView([], 'delete');
		}

		/**
		 * Add a new snippet.
		 * @param  [type] $id [description]
		 * @return [type]     [description]
		 */
		public function onAdd(){
			$this->renderView([], 'add');
		}

		public function onAddPost($data){
			$id = Api::$Snippet->create(
				$data['title'],
				$data['code'],
				$data['description'],
				$data['lang'],
				$data['framework']
			);
			System::redirectTo('snippet/' . $id['ID']);
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
