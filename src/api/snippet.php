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
		$user = System::$Auth->getUser();


		$result['Voted'] = -1;
		if(!empty($user)){
			// Check if the user already votes on this snippet.
			$model = new Model_Vote_Snippet();
			$votes = $model->where("Snippet_ID", '=', $id)->where("Vote_user_ID","=",$user['ID'])->first();
			if(!empty($votes)){
				$result['Voted'] = $votes->toArray()['Vote_type'];
			}
		}

		
		$result['User'] = User::getById($result['User_ID']);
		$result['Comments'] = Comment::getBySnippetID($id);
		$result['Votes'] = Vote::getBySnippetID($id);
		return $result->toArray();
	}

	/**
	 * Get the latest snippets.
	 */
	public function getLastest(){
		$model = new Model_Snippet();
		$result = $model->orderBy('Date', 'DESC')->limit(10)->get()->toArray();
		$newResults = [];
		foreach($result as $snippet){
			$newResults[] = Snippet::getByID($snippet['ID']);
		}
		$result = $newResults;

		return $result;
	}


	/**
	 * Get snippet by user.Username.
	 */
	public function getByUserID($id){
		$model = new Model_Snippet();
		$result = $model->where('User_ID', '=', $id)->get()->toArray();

		if(empty($result)){
			return false;
		}

		$newResults = [];
		foreach($result as $snippet){
			$newResults[] = Snippet::getByID($snippet['ID']);
		}
		$result = $newResults;

		return $result;		
	}


	/**
	 * Check if an snippet exists by snippet id.
	 * @param  [type] $id [The id of the snippet]
	 * @return [type]     [description]
	 */
	public function existByID($id){
		$model = new Model_Snippet();
		$result = $model->find($id);
		if(empty($result)){
			return false;
		}
		return true;
	}

	/**
	 * Create a new Snippet
	 * @param  [type] $title       [The title of the snippet]
	 * @param  [type] $code        [The code of the snippet]
	 * @param  [type] $description [The description of the snippet]
	 * @param  [type] $lang        [The languageID of the snippet]
	 * @param  [type] $framework   [The frameworkID of the snippet]
	 * @param  [type] $userID      [The userID of the user which is creating the snippet]
	 * @return [type]              [description]
	 */
	public function create($title, $code, $description, $lang, $framework, $userID){
		$model = new Model_Snippet();
		$language = Snippet::getLanguageByID($lang);
		$contents = file_get_contents("http://127.0.0.1:3000?code=".urlencode($_POST['code'])."&language=".$language);

		return $model->create([
			"Title" => $title,
			"Code" =>	$code,
			"Description" => $description,
			"Lang" => $lang, 
			"Framework" => $framework,
			"User_ID" => $userID,
			"Date" => date("Y-m-d"),
			"Views" => 0,
			"Code_Styled" => $contents
		]);	
	}

	/**
	 * Update a snippet by SnippetID.
	 * @param  [type] $id   [The id of the snippet]
	 * @param  [type] $data [The data of the snippet that must be updated]
	 * @return [type]       [description]
	 */
	public function updateById($id, $data){
		$model = new Model_Snippet();
		$snippet = $model->find($id);
		
		if(empty($snippet)){
			return false;
		}
		$model->find($id)->update([
			'Title' => $data['title'],
			'Code' => $data['code'],
			'Description' => $data['description'],
			'Lang' => $data['language'],
			'Framework' => $data['framework']
		]);
	}

	/**
	 * Get all the languages from the database.
	 * @return [type] [description]
	 */
	public function getLanguages(){
		$model = new Model_Proglang();
		return $model->get()->toArray();
	}

	/**
	 * Get all the frameworkd from the database.
	 * @return [type] [description]
	 */
	public function getFrameworks(){
		$model = new Model_Framework();
		return $model->get()->toArray();
	}

	/**
	 * Get a language by languageID.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getLanguageByID($id){
		$model = new Model_ProgLang();
		$result = $model->where('language_ID','=',$id)->first();
		return $result['language_name'];
	}

	/**
	 * Search the database for snippets.
	 * @param  [type] $query [The query for searching]
	 * @return [type]        [description]
	 */
	public function search($query, $languageID){
		$model = new Model_Snippet();
		$result = $model->where('Lang', '=', $languageID)
			->where(function($q) use ($query){
				return $q->where('title', 'LIKE', '%'.$query.'%')
				->orWhere('description', 'LIKE', '%'.$query.'%');
			})
			->get()->toArray();

		if(!empty($result)){
			$newResults = [];
			foreach($result as $snippet){
				$newResults[] = Snippet::getByID($snippet['ID']);
			}
			$result = $newResults;
		}

		return $result;
	}


	public function deleteById($id){
		$model = new Model_Snippet();
		$exists = Snippet::existByID($id);
		if($exists == false){
			return false;
		}

		$result = $model->find($id)->delete();
		return $result;
	}

}