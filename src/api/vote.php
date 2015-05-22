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
	 * @param  [type] $id [description]
	 * @return [type]     [description]
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

	/**
	 * Vote a snipept up or down.
	 * @param  [type] $id       [Snippet id]
	 * @param  [type] $vote     [Votetype (0 = downvote, 1 = upvote)]
	 * @param  [type] $voteUser [The userID of the user that is voting]
	 * @return [type]           [description]
	 */
	public function voteSnippet($id, $vote, $voteUser){
		$model = new Model_Vote_Snippet();
		$result = $model->find($user);
		if(empty($result)){
			try{
				$voteCreate = $model->create([
					'Vote_ID' => 'NULL', 
					'Vote_user_ID' => $voteUser, 
					'Vote_type' => $vote, 
					'Snippet_ID' => $id
				]);
			}catch(\Illuminate\Database\QueryException $e){
				return false;
			}
			return true;
		}
		return false;
	}

	/**
	 * Vote a comment up or down.
	 * @param  [type] $id       [The id of the comment]
	 * @param  [type] $vote     [Votetype (0 = downvote, 1 = upvote)]
	 * @param  [type] $voteUser [The userID of the user that is voting]
	 * @return [type]           [description]
	 */
	public function voteComment($id, $vote, $voteUser){
		$model = new Model_Vote_Snippet();
		$result = $model->find($user);
		if(empty($result)){
			try{
				$voteCreate = $model->create([
					'Vote_ID' => 'NULL', 
					'Vote_user_ID' => $voteUser, 
					'Vote_type' => $vote, 
					'Comment_ID' => $id
				]);
			}catch(\Illuminate\Database\QueryException $e){
				return false;
			}
			return true;
		}
		return false;
	}

	/**
	 * Vote a user up or down.
	 * @param  [type] $vote     [Votetype (0 = downvote, 1 = upvote)]
	 * @param  [type] $voteUser [The userID of the user that is voting]
	 * @param  [type] $user     [The userID of the user which the vote is for]
	 * @return [type]           [description]
	 */
	public function voteUser($vote, $voteUser, $user){
		$model = new Model_Vote_User();
		$result = $model->find($user);
		if(empty($result)){
			try{
				$voteCreate = $model->create([
					'Vote_ID' => 'NULL', 
					'Vote_user_ID' => $voteUser, 
					'User_ID' => $user, 
					'Vote_type' => $vote, 
					]);
			}catch(\Illuminate\Database\QueryException $e){
				return false;
			}
			return true;
		}
		return false;
	}

}