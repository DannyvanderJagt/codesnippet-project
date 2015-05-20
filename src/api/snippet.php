<?php

// Load the required models.
require_once 'model/snippet.model.php';
require_once 'model/vote_snippet.model.php';
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

	public function existByID($id){
		$model = new Model_Snippet();
		$result = $model->find($id);
		if(empty($result)){
			return false;
		}
		return true;
	}

	public function vote($id, $vote, $voteUser, $user){
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

	public function updateById($id, $data){
		$model = new Model_Snippet();
		$snippet = $model->find($id);
		
		if(empty($snippet)){
			return false;
		}

		$snippet->update($data);
	}

	public function getAllLanguages(){
		$model = new Model_Proglang();
		return $model->get()->toArray();
	}

	public function getAllFrameworks(){
		$model = new Model_Framework();
		return $model->get()->toArray();
	}
}