<?php

// Load the required models.
require_once 'model/user.model.php';

class User{

	public function __construct(){
		
	}

	/**
	 * Get an user by its id.
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getByID($id){
		$model = new Model_User();
		$result = $model->find($id);

		if(empty($result)){
			return null;
		}

		$result = $result->toArray();
		// unset($result['Password']);	// Remove the password!
		return $result;
	}

	/**
	 * Get an user by its Session Key.
	 * @param  [type] $key [description]
	 * @return [type]      [description]
	 */
	public function getBySessionKey($key){
		$model = new Model_User();
		$result = $model->where("Session_key", '=', $key)->first();

		if(empty($result)){
			return null;
		}

		$result = $result->toArray();
		unset($result['Password']);	// Remove the password!
		return $result;
	}

	/**
	 * Get an user by its username.
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function getByUsername($username){
		$model = new Model_User();
		$result = $model->where("Username", '=', $username)->first();

		if(empty($result)){
			return null;
		}

		$result = $result->toArray();
		unset($result['Password']);	// Remove the password!
		return $result;
	}

	/**
	 * Check if an user exists (by id)
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function existByID($id){
		$model = new Model_User();

		$result = $model->find($id);
		if(empty($result)){
			return false;
		}
		return true;
	}

	public function existByUsernameAndPassword($username, $password){
		$model = new Model_User();
		$result = $model->where(['Username'=> $username, 'Password'=>$password])->count();

		if(empty($result)){
			return false;
		}
		return true;
	}

	public function storeSessionKey($username, $key){
		$model = new Model_User();
		$result = $model->where('Username','=',$username)->first()->update(['Session_key'=>$key]);
	}
	
}