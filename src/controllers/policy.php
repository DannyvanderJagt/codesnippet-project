<?php

class Policy extends Controller
{
	private $templates = PAGES['policy']['templates'];

	public function load($params = []){
		$this->display($this->templates[0]);
	}
}
