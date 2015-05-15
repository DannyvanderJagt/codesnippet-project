<?php
/**
 *	This file will load the basic files that 
 *	are necessary to get things going.
 */

// Config file.
include_once '../config.php';

// Load the autoload of composer.
require_once '../assets/libs/autoload.php';

// Load the database connection.
require_once 'database.php';

// System components.
include_once('error.php');
include_once('../api/index.php');
include_once('../core/auth.php');
include_once('router.php');


// Extenable classes.
include_once('controller.php');

/**
 * The System class will load the Router 
 * and provide a few basic functions. 
 */
class System{

	static $Auth = null;
	static $Router = null;
	static $Api = null;

	public function __construct(){
		self::$Api = new Api();
		self::$Auth = new Auth();
		self::$Router = new Router();
		self::$Router->load();
	}

	public function redirectToHome(){
		System::redirectTo('home');
		exit();
	}

	public function redirectTo($page){
		header("Location: http://". $_SERVER['SERVER_NAME'] . '/' . $page);
		exit();
	}

	public function pageNotFound($page){
		Error::PageNotFound($page);
		System::redirectTo('404');
	}

	/**
	 * Convert an Array into json in a readable way.
	 * Source: http://php.net/manual/en/function.json-encode.php
	 * @param  [type]  $in         [description]
	 * @param  integer $indent     [description]
	 * @param  boolean $from_array [description]
	 * @return [type]              [description]
	 */
	public function json_readable_encode($in, $indent = 0, $from_array = false)
	{
	    $_escape = function ($str)
	    {
	        return preg_replace("!([\b\t\n\r\f\"\\'])!", "\\\\\\1", $str);
	    };

	    $out = '';

	    foreach ($in as $key=>$value)
	    {
	        $out .= str_repeat("\t", $indent + 1);
	        $out .= "\"".$_escape((string)$key)."\": ";

	        if (is_object($value) || is_array($value))
	        {
	            $out .= "\n";
	            $out .= self::json_readable_encode($value, $indent + 1);
	        }
	        elseif (is_bool($value))
	        {
	            $out .= $value ? 'true' : 'false';
	        }
	        elseif (is_null($value))
	        {
	            $out .= 'null';
	        }
	        elseif (is_string($value))
	        {
	            $out .= "\"" . $_escape($value) ."\"";
	        }
	        else
	        {
	            $out .= $value;
	        }

	        $out .= ",\n";
	    }

	    if (!empty($out))
	    {
	        $out = substr($out, 0, -2);
	    }

	    $out = str_repeat("\t", $indent) . "{\n" . $out;
	    $out .= "\n" . str_repeat("\t", $indent) . "}";

	    return $out;
	}


}

// Create a new instance.
$Sys = new System();