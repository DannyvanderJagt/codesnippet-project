<?php

class Home extends Controller
{
	public function load($params = []){
		echo 'load home';
		print_r($params);
	}
}
