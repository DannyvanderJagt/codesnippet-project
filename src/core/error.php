<?php

/**
 * Error class
 *
 * Catch and log errors that occur for debugging.
 */
class Error{

	public function __construct(){

	}

	/**
	 * Log an error and exit the current process.
	 */
	public function ExitProcess($msg){
		exit();
	}

	/**
	 * Log an page not found error.
	 * @param [type] $pagename [description]
	 */
	public function PageNotFound($pagename){

	}

	/**
	 * Log an error.
	 * @param [type] $msg [description]
	 */
	public function Log($msg){

	}

}
