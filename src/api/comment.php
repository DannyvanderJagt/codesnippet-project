<?php

// Load the required models.
require_once 'model/comment.model.php';
require_once 'model/user.model.php';

class Comment{

	public function __construct(){
		
	}

	public function getByUserID($id){
		$model = new Model_Comment();

		$comments = $model->where('User_ID', $id)->get();
		
		if(empty($comments)){
			return null;
		}

		return $comments->toArray();
	}

	/**
	 * Get all the comments by an snippet id.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getBySnippetID($id){
		$model = new Model_Comment();
		
		$comments = $model
			->where('Snippet_ID','=',$id)
			->orderBy('Comment_top_ID', 'asc')
			->with('User')
			->get()
			->toArray();
			
		if(empty($comments)){
			return null;
		}

		$newOrder = [];

		// Subcomment logic.
		foreach($comments as $comment){
			if(!empty($comment['Comment_top_ID'])){
				// This is an subcomment.
				$comment['Votes'] = Vote::getByCommentID($comment['Comment_ID']);
				$newOrder[$comment['Comment_top_ID']]['SubComments'][] = $comment;
			}else{
				// This is an top comment.
				$comment['Votes'] = Vote::getByCommentID($comment['Comment_ID']);
				$comment['SubComments'] = [];
				$newOrder[$comment['Comment_ID']] = $comment;
			}
		}
		return $newOrder;
	}


	public function addBySnippetID($snippetID, $commentText, $topCommentID = null){
		$comment = new Model_Comment();
		// Check for login.
		if(!System::$Auth->required()){
			return false;
		}
		
		// Check for snippet exists.
		if(!Snippet::existByID($snippetID)){
			return false;
		}

		$comment->create([
			"Comment_ID" => null,
			"Snippet_ID" => $snippetID,
			"Comment_top_ID" => $topCommentID,
			"User_ID" => System::$Auth->getUser()['ID'],
			"Comment_text" => $commentText,
			"Comment_date" => date("Y-m-d")
		]);
		return true;
	}

}