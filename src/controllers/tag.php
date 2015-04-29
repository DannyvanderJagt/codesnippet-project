<?php

class Tag extends Controller
{
	private $templates = PAGES['tag']['templates'];

	public function load($params = []){
		$this->display($this->templates[0]);
	}
}
