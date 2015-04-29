<?php

class About extends Controller
{
	private $templates = PAGES['about']['templates'];

	public function load($params = []){
		$this->display($this->templates[0]);
	}
}
