<?php

class NotFound extends Controller
{
	private $templates = PAGES['404']['templates'];

	public function __construct(){
		parent::__construct();
		$this->user = $this->model('user');
	}

	public function load($params = []){
		print_r($_COOKIE);
	}
}
