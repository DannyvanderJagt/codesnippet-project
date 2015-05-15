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
		$userUp = $userModel::where('User_ID', '=', $id)->where('Vote_type','=',0)->count();
		$userDown = $userModel::where('User_ID', '=', $id)->where('Vote_type','=',1)->count();

		// Snippet table.
		$snippetUp = $snippetModel::where('User_ID', '=', $id)->where('Vote_type','=',0)->count();
		$snippetDown = $snippetModel::where('User_ID', '=', $id)->where('Vote_type','=',1)->count();

		// Comment table.
		$commentUp = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',0)->count();
		$commentDown = $snippetModel->where('User_ID', '=', $id)->where('Vote_type','=',1)->count();

		$totalUp = $userUp + $snippetUp + $commentUp;
		$totalDown = $userDown + $snippetDown + $commentDown; 

		return [
			'totalUpVotes'=>$totalUp,
			'totalDownVotes'=>$totalDown,
			'userUpVotes' => $userUp,
			'userDownVotes' => $userDown,
			'snippetUpVotes' => $snippetUp,
			'snippetDownVotes' => $snippetDown,
			'commentUpVotes' => $commentUp,
			'commentDownVotes' => $commentDown
		];
	}

}