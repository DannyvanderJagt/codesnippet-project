<?php

class Signout extends Controller
{
	private $templates = PAGES['signout']['templates'];

	public function load($params = []){
		global $Session;

		$this->display($this->templates['default']);

		$Session->signout();
	}
}
