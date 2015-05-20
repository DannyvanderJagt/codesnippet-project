<?php

// Load the required models.
require_once 'model/snippet.model.php';
require_once 'model/vote_snippet.model.php';
require_once 'model/vote_comment.model.php';
require_once 'model/prog_lang.model.php';
require_once 'model/framework.model.php';

/**
 * Get, Update and remove any snippet.
 */
class Snippet{

	public function __construct(){
	
	}

	/**
	 * Get Snippet by its id.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getById($id){
		$model = new Model_Snippet();
		$result = $model->find($id);
		$result->Language;
		$result->framework;


		if(empty($result)){
			return null;
		}
		
		$result['User'] = User::getById($result['User_ID']);
		$result['Comments'] = Comment::getBySnippetID($id);
		$result['Votes'] = Vote::getBySnippetID($id);
		return $result->toArray();
	}

	public function updateById($id, $data){
		$model = new Model_Snippet();
		$snippet = $model->find($id);
		
		if(empty($snippet)){
			return false;
		}

		$snippet->update($data);
	}
}