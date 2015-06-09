<?php


/**
 * Api: This class will load and contain all the api elements.
 */

require_once('snippet.php');
require_once('vote.php');
require_once('user.php');
require_once('comment.php');
require_once('mail.php');

class Api{
	
	// Vars.
	private static $available = ['Snippet', 'Comment', 'User', 'Vote', 'Mail'];
	public static $Snippet;
	public static $Comment;
	public static $User;
	public static $Vote;
	public static $Mail;

	public function __construct(){
		self::$Snippet = new \Snippet();
		self::$Comment = new \Comment();
		self::$User = new \User();
		self::$Vote = new \Vote();
		self::$Mail = new \Mail();
	}

	public function exist($name){
		if(!in_array($name, Api::$available)){
			return false;
		}
		if(!class_exists($name)){
			return false;
		}
		return true;
	}
}