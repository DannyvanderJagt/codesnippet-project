<?php

class Snippets extends Controller
{
	private $templates = PAGES['snippet']['templates'];

	public function load($params = []){
		echo 'Load Snippet';

		$this->snippet = $this->model('snippet');
		$result = $this->snippet->find(4);
		
		// $snippet = Snippet::find(4);
		// print_r($snippet);
		$this->display($this->templates[0]);
		
	}
}