<?php

class Signin extends Controller
{
	private $templates = PAGES['signin']['templates'];

	public function load($params = []){
		global $Session;
		print_r($params);
		$template = $this->twig->loadTemplate($this->templates[0].'.html');
		$template->display([]);

		$Session->login();
	}
}
