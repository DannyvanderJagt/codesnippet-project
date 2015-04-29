<?php

class Upload extends Controller
{
	private $templates = PAGES['upload']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
