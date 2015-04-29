<?php

class Contact extends Controller
{
	private $templates = PAGES['contact']['templates'];

	public function load($params = []){
		$this->display($this->templates['default']);
	}
}
