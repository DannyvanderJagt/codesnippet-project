<?php

// Load the required models.
require_once 'model/vote_comment.model.php';
require_once 'model/vote_snippet.model.php';
require_once 'model/vote_user.model.php';

class Vote{

	public function __construct(){
		
	}

	/** 
	 * Get all the up and down votes of an User.
	 */
	public function getByUserID($id){
		// Check if the user exists.
		if(!User::existByID($id)){
			return null;
		}

		$userModel = new Model_Vote_User();
		$snippetModel = new Model_Vote_Snippet();
		$commentModel = new Model_Vote_Comment();

		// User table votes.
		$userUp = $userModel->where('User_ID', '=', $id)->where('Vote_type','=',1)->count();
		$userDown = $userModel->where('User_ID', '=', $id)->where('Vote_type','=',0)->count();

		// Snippet table.
		$snippetUp = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',1)->count();
		$snippetDown = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',0)->count();

		// Comment table.
		$commentUp = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',1)->count();
		$commentDown = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',0)->count();
	
		$totalUp = $userUp + $snippetUp + $commentUp;
		$totalDown = $userDown + $snippetDown + $commentDown; 

		return [
			'up'=>$totalUp,
			'down'=>$totalDown,
			'userUpVotes' => $userUp,
			'userDownVotes' => $userDown,
			'snippetUpVotes' => $snippetUp,
			'snippetDownVotes' => $snippetDown,
			'commentUpVotes' => $commentUp,
			'commentDownVotes' => $commentDown
		];
	}

	/**
	 * Get the up and down votes of a snippet by its id.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getBySnippetID($id){
		$model = new Model_Vote_Snippet();

		$up = $model->where('Snippet_ID', $id)->where('Vote_type', '=', 1)->count();
		$down = $model->where('Snippet_ID', $id)->where('Vote_type', '=', 0)->count();

		return [
			'up' => $up,
			'down' => $down
		];
	}

	/**
	 * Get the up and down vote of a comment by its id.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getByCommentID($id){
		$model = new Model_Vote_Comment();

		$up = $model->where('Comment_ID', $id)->where('Vote_type', '=', 1)->count();
		$down = $model->where('Comment_ID', $id)->where('Vote_type', '=', 0)->count();

		return [
			'up' => $up,
			'down' => $down
		];
	}
	public function voteSnippet($id, $vote, $voteUser, $user){
		$model = new Model_Vote_Snippet();
		$result = $model->find($user);
		if(empty($result)){
			$voteCreate = $model->create([
				'Vote_ID' => 'NULL', 
				'Vote_user_ID' => $voteUser, 
				'User_ID' => $user, 
				'Vote_type' => $vote, 
				'Snippet_ID' => $id
				]);
			return true;
		}
		return false;
	}

	public function voteComment($id, $vote, $voteUser, $user){
		$model = new Model_Vote_Snippet();
		$result = $model->find($user);
		if(empty($result)){
			$voteCreate = $model->create([
				'Vote_ID' => 'NULL', 
				'Vote_user_ID' => $voteUser, 
				'User_ID' => $user, 
				'Vote_type' => $vote, 
				'Comment_ID' => $id
				]);
			return true;
		}
		return false;
	}

		public function voteUser($vote, $voteUser, $user){
		$model = new Model_Vote_User();
		$result = $model->find($user);
		if(empty($result)){
			$voteCreate = $model->create([
				'Vote_ID' => 'NULL', 
				'Vote_user_ID' => $voteUser, 
				'User_ID' => $user, 
				'Vote_type' => $vote, 
				]);
			return true;
		}
		return false;
	}

}