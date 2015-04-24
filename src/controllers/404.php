<?php

class NotFound extends Controller
{
	public function load(){
		$template = $this->twig->loadTemplate('home.html');

		$params = array(
			'name' => 'Danny'
		);
		$template->display($params);
	}
}
