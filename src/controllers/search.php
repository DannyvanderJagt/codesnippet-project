<?php

class Search extends Controller
{
	private $templates = PAGES['search']['templates'];

	public function load($params = []){
		$this->display($this->templates[0]);
	}
}
