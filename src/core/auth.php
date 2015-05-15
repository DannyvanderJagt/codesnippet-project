<?php

/**
 * Session: Handles the authentication.
 */
class Auth
{
	private $sessionExpireDate = 1 * 60 * 60; // 1 Day.
	private $key; // Store a unique key connected to 1 user.
	private $time; // The last time on login.
	private $loggedin = false;

	// User.
	private $loggedInUser;

	/**
	 * Constructor.
	 */
	public function __construct(){
		$this->load();
	}

	/**
	 * Load the session.
	 * @return [type] [description]
	 */
	public function load(){
		$set = 0;
		if(isset($_COOKIE['time'])){
			$set++;
		}
		if(isset($_COOKIE['key'])){
			$set++;
		}
		
		if($set != 2){
			// No valid login session data.
			$this->loggedin = false;
			$this->signout();
			return false;
		}

		// Check time.
		if($_COOKIE['time'] < time() - $this->sessionExpireDate){
			$this->loggedin = false;
			// Destroy the cookie.
			$this->signout();
			return false;
		}

		$this->key = $_COOKIE['key'];
		$this->time = $_COOKIE['time'];

		// Try to find the key in the database.
		$user = User::getBySessionKey($this->key);

		// Check for count.
		if($user == null){
			return false;
		}

		// The user is now loggedin.
		$this->loggedInUser = $user;
		$this->loggedin = true;

		setcookie("key", $this->key, time() + $this->sessionExpireDate,'/');
	}

	/**
	 * Check if a user is loggedin.
	 * @return boolean [description]
	 */
	public function required(){
		return $this->loggedin;
	}

	/**
	 * Generate a unique key.
	 * @return [type] [description]
	 */
	private function generateKey(){
		return md5(microtime().rand());
	}

	/**
	 * Login in.
	 * @param  [String] $username [The username]
	 * @param  [String] $password [The password md5!]
	 * @return [type]           [description]
	 */
	public function signin($username, $password){
		// Check for username and password.
		$exists = User::existByUsernameAndPassword($username, $password);
		// Check the count.
		if($exists == false){
			return false;
		}

		// Set key.
		$key = $this->generateKey();

		// Set the cookie.
		setcookie("time", time(), time() + $this->sessionExpireDate,'/');
		setcookie("key", $key, time() + $this->sessionExpireDate,'/');

		// Store the key in the database.
		User::storeSessionKey($username, $key);
		
		// Redirect to the home page.
		return true;
	}

	/**
	 * Signout
	 * @return [type] [description]
	 */
	public function signout(){
		unset($_COOKIE['time']);
		unset($_COOKIE['key']);
		setcookie('time', '', time(),'/');
		setcookie('key', '', time(),'/');
		return true;
	}

	/**
	 * Get the user data of the user that is loggedin.
	 * @return [type] [description]
	 */
	public function getUser(){
		return $this->loggedInUser;
	}

}