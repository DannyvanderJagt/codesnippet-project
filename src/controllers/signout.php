<?php

class Signout extends Controller
{
	private $templates = PAGES['signout']['templates'];

	public function load($params = []){
		global $Session;

		$template = $this->twig->loadTemplate($this->templates[0].'.html');
		$template->display([]);

		$Session->signout();
	}
}
