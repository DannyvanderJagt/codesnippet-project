<?php

// Load the required models.
require_once 'model/snippet.model.php';

/**
 * Get, Update and remove any snippet.
 */
class Snippet{

	public function __construct(){
	
	}

	public function getById($id){
		$model = new Model_Snippet();
		return $model->find($id)->toArray();
	}

	public function find(){

	}
}

