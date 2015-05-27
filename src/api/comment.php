<?php

// Load the required models.
require_once 'model/comment.model.php';
require_once 'model/user.model.php';

class Comment{

	public function __construct(){
		
	}

	/**
	 * Get every comment created by this userID.
	 * @param  [type] $id [The userID of the user]
	 * @return [type]     [description]
	 */
	public function getByUserID($id){
		$model = new Model_Comment();

		$comments = $model->where('User_ID', $id)->get();
		
		if(empty($comments)){
			return null;
		}

		return $comments->toArray();
	}

	public function getByID($id){
		$model = new Model_Comment();
		$comment = $model->find($id);

		if(empty($comment)){
			return false;
		}
		return $comment->toArray();
	}

	/**
	 * Get all the comments by an snippet id.
	 * @param  [type] $id [The ID of the snippet]
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

		$userid = System::$Auth->getUser()['ID'];

		// Subcomment logic.
		foreach($comments as $comment){
			if(!empty($comment['Comment_top_ID'])){
				// This is an subcomment.
				$comment['Votes'] = Vote::getByCommentID($comment['Comment_ID']);
				$voted = Model_Vote_Comment::where(["Comment_ID" => $comment["Comment_ID"], "Vote_user_ID"=>$userid])->first();
				if($voted == null){
					$comment['Voted'] = -1;
				}else{
					$comment['Voted'] = $voted['Vote_type'];
				}

				$newOrder[$comment['Comment_top_ID']]['SubComments'][] = $comment;
			}else{
				// This is an top comment.
				$comment['Votes'] = Vote::getByCommentID($comment['Comment_ID']);
				$voted = Model_Vote_Comment::where(["Comment_ID" => $comment["Comment_ID"], "Vote_user_ID"=>$userid])->first();
				if($voted == null){
					$comment['Voted'] = -1;
				}else{
					$comment['Voted'] = $voted->toArray()['Vote_type'];
				}

				$comment['SubComments'] = [];
				$newOrder[$comment['Comment_ID']] = $comment;
			}
		}
		return $newOrder;
	}


	/**
	 * Add a comment to a snippet.
	 * @param [type] $snippetID    [The id of the snippet]
	 * @param [type] $commentText  [The comment]
	 * @param [type] $topCommentID [The id of the top comment]
	 */
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