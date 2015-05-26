<?php

// Load the required models.
require_once 'model/user.model.php';
require_once 'model/vote_user.model.php';

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

		$result['Votes'] = Vote::getByUserID($id);
		$result = $result->toArray();
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
		$result['Votes'] = Vote::getByUserID($result['ID']);
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
		$result['Votes'] = Vote::getByUserID($result['ID']);
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

	/**
	 * Check if an username and password are correct.
	 * @param  [type] $username [The username]
	 * @param  [type] $password [The password]
	 * @return [type]           [description]
	 */
	public function existByUsernameAndPassword($username, $password){
		$model = new Model_User();
		$result = $model->where(['Username'=> $username, 'Password'=>$password])->count();

		if(empty($result)){
			return false;
		}
		return true;
	}

	/**
	 * Store a session key for a user.
	 * @param  [type] $username [The username]
	 * @param  [type] $key      [The sessionkey]
	 * @return [type]           [description]
	 */
	public function storeSessionKey($username, $key){
		$model = new Model_User();
		$result = $model->where('Username','=',$username)->first()->update(['Session_key'=>$key]);
	}

	/**
	 * Create a new user.
	 * @param  [type] $username   [description]
	 * @param  [type] $password   [description]
	 * @param  [type] $first_name [description]
	 * @param  [type] $last_name  [description]
	 * @param  [type] $email      [description]
	 * @param  [type] $birthday   [description]
	 * @param  [type] $profession [description]
	 * @param  [type] $picture    [description]
	 * @return [type]             [description]
	 */
	public function create($username, $password, $first_name, $last_name, $email, $birthday, $profession, $picture, $picture_thumb){
		$model = new Model_User();
		$user = $model->create([
				'ID' => 'NULL',
				'Username' => $username,
				'Password' => $password,
				'First_name' => $first_name,
				'Last_name' => $last_name,
				'Email' => $email,
				'Birthday' => $birthday,
				'Profession' => $profession,
				'Profile_picture_large' => $picture,
				'Profile_picture_thumb' => $picture_thumb,
				'Votes' => 'NULL',
				'Session_key' => 'NULL',
				'Last_online' => 'NULL',
				'Register_date' => 'NULL']);
	}

	/**
	 * Update data of an user by its id.
	 * @param  [type] $id   [description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function update($id, $data){
		$model = new Model_User();
		$user = $model->find($id);
		if($user){
			$user->update([
				'First_name' => $data['firstname'],
				'Last_name' => $data['lastname'],
				'Email' => $data['email'],
				'Birthday' => $data['birthday'],
				'Profession' => $data['profession']
			]);
		}
	}
	
}