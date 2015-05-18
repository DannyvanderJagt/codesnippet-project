<?php

// Load the required models.
require_once 'model/snippet.model.php';

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

		if(empty($result)){
			return null;
		}

		$result['Comments'] = Comment::getBySnippetID($id);
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

