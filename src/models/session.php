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

	public function load(){
		print_r($_COOKIE);
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
		$result = $this->user->where('Session_key','=','a0c563ad25a742ff40973fbbf1d94b8a')->count();

		// TODO: Check for count.
		
		
		$this->loggedin = true;
		var_dump($this->loggedin);
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

	public function login(){
		$username = 'Danny';
		$password = 'Welkom01';
		$key = $this->generateKey();

		setcookie("time", time(), time() + $this->sessionExpireDate,'/');
		setcookie("key", $key, time() + $this->sessionExpireDate,'/');

		$this->user = new User();
		$this->user->where('Username',$username)->update(['Session_key' => $key]);
		echo $key;
		
		header("Location: home");
	}

}

$Session = new Session();
$Session->load();
