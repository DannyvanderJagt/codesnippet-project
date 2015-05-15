<?php

// Load the required models.
require_once 'model/comment.model.php';
require_once 'model/user.model.php';

class Comment{

	public function __construct(){
		
	}

	public function getByUser($id){
		return array('id'=>$id);
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
				$newOrder[$comment['Comment_top_ID']]['SubComments'][] = $comment;
			}else{
				// This is an top comment.
				$comment['SubComments'] = [];
				$newOrder[$comment['Comment_ID']] = $comment;
			}
		}
		return $newOrder;
	}

}