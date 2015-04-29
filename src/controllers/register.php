<?php

class Register extends Controller
{
	private $templates = PAGES['register']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
