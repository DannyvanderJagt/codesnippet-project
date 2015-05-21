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


	public function existByID($id){
		$model = new Model_Snippet();
		$result = $model->find($id);
		if(empty($result)){
			return false;
		}
		return true;
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

	public function create($title, $code, $description, $lang, $framework, $userID){
		$model = new Model_Snippet();
		$language = Snippet::getLanguageByID($lang);
		$contents = file_get_contents("http://127.0.0.1:3000?code=".urlencode($_POST['code'])."&language=".$language);

		return $model->create([
			"Title" => $title,
			"Code" =>	$language,
			"Description" => $description,
			"Lang" => $lang, 
			"Framework" => $framework,
			"User_ID" => $userID,
			"Date" => date("Y-m-d"),
			"Views" => 0,
			"Code_Styled" => $contents
		]);	
	}

	public function updateById($id, $data){
		$model = new Model_Snippet();
		$snippet = $model->find($id);
		
		if(empty($snippet)){
			return false;
		}

		$snippet->update($data);
	}

	public function getLanguages(){
		$model = new Model_Proglang();
		return $model->get()->toArray();
	}

	public function getFrameworks(){
		$model = new Model_Framework();
		return $model->get()->toArray();
	}

	public function getLanguageByID($id){
		$model = new Model_ProgLang();
		$result = $model->where('language_ID','=',$id)->first();
		return $result['language_name'];
	}



}