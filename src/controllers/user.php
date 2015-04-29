<?php

class User extends Controller
{
	private $templates = PAGES['user']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
