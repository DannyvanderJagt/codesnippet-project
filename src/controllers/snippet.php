<?php

class Snippet extends Controller
{
	public function load($params = []){
		echo 'Load Snippet';
		print_r($params);
	}
}
