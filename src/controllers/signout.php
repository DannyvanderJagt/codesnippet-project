<?php

class Signout extends Controller
{
	private $templates = PAGES['signout']['templates'];

	public function load($params = []){
		print_r($params);
		$template = $this->twig->loadTemplate($this->templates[0].'.html');
		$template->display([]);
	}
}