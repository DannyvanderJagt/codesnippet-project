<?php

// Check session cookie
// Check serial with database.
// Loggedin = false / true.
// true -> Load userdata.

use Illuminate\Database\Eloquent\Model as Eloquent; 

require('user.php');

class Session extends Eloquent
{
	// Database.
	// protected $table = 'user';
	// public $timestamps = [];
	// protected $fillable = ['Username', 'email'];
	private $sessionExpireDate = 1 * 60 * 60; // 1 Day.
	private $key;
	private $time;
	private $loggedin = false;

	public function __construct(){
		parent::__construct();
		$this->user = new User();
	}

	public function load(){
		// print_r($_COOKIE);
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

		// echo $this->key;
		// Try to find the key in the database.
		$this->user = new User();
		$count = $this->user->where('Session_key','=',$this->key)->count();

		// Check for count.
		if($count != 1){
			return false;
		}

		// The user is now loggedin.
		$this->loggedin = true;
	}

	public function isLoggedin(){
		return $this->loggedin;
	}

	private function generateKey(){
		return md5(microtime().rand());
	}

	public function getKey(){
		return $this->key;
	}

	public function login($username, $password){
		// Check for username and password.
		// 
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
		header("Location: http://localhost/home");
		exit();
	}

	public function signout(){
		echo 'signout';
		unset($_COOKIE['time']);
		unset($_COOKIE['key']);
		setcookie('time', '', time(),'/');
		setcookie('key', '', time(),'/');
		
		header("Location: http://localhost/signin");
		exit();
	}

}

// Create a new session.
$Session = new Session();
$Session->load();
