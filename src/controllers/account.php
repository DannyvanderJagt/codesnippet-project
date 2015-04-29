<?php

class Account extends Controller
{
	private $templates = PAGES['account']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
