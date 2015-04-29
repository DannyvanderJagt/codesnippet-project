<?php

class Home extends Controller
{
	private $templates = PAGES['home']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
