<?php

// Check session cookie
// Check serial with database.
// Loggedin = false / true.
// true -> Load userdata.

use Illuminate\Database\Eloquent\Model as Eloquent; 

require('user.php');

class Session
{
	private $sessionExpireDate = 1 * 60 * 60; // 1 Day.
	private $key; // Store a unique key connected to 1 user.
	private $time; // The last time on login.
	private $loggedin = false;

	/**
	 * Constructor.
	 */
	public function __construct(){
		$this->user = new User();
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
			echo 'unvalid data!';
			$this->loggedin = false;
			return false;
		}

		// Check time.
		if($_COOKIE['time'] < time() - $this->sessionExpireDate){
			echo 'Time expired!';
			return false;
		}

		$this->key = $_COOKIE['key'];
		$this->time = $_COOKIE['time'];

		// Try to find the key in the database.
		$this->user = new User();
		$count = $this->user->where('Session_key','=',$this->key)->count();

		// Check for count.
		if($count != 1){
			return false;
		}

		// The user is now loggedin.
		$this->loggedin = true;
		setcookie("key", $key, time() + $this->sessionExpireDate,'/');
	}

	/**
	 * Check if a user is loggedin.
	 * @return boolean [description]
	 */
	public function isLoggedin(){
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
	 * Get the unique key.
	 * @return [type] [description]
	 */
	public function getKey(){
		return $this->key;
	}

	/**
	 * Login in.
	 * @param  [String] $username [The username]
	 * @param  [String] $password [The password md5!]
	 * @return [type]           [description]
	 */
	public function login($username, $password){
		// Check for username and password.
		$count = $this->user->where(['Username' => $username, 'Password' => $password])->count();

		// Check the count.
		if($count != 1){
			return false;
		}

		// Set key.
		$key = $this->generateKey();

		// Set the cookie.
		setcookie("time", time(), time() + $this->sessionExpireDate,'/');
		setcookie("key", $key, time() + $this->sessionExpireDate,'/');

		// Store the key in the database.
		$this->user->where('Username',$username)->update(['Session_key' => $key]);
		
		// Redirect to the home page.
		redirectToPage('home');
		exit();
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
		
		redirectToPage('signin');
	}

}

// Create a new session.
$Session = new Session();
$Session->load();
