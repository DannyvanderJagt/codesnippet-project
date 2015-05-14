<?php

/**
 * Page: Notfound / 404
 * This will be loaded when a requested page doens't exists or can't be found.
 */
class NotFound extends Controller
{
	protected $views = [ 
		"default" => "404.html"
	];

	public function onRequest($params = []){
		$this->renderView();
	}
}
