<?php

class Home extends Controller
{
	public function load($params = []){
		echo 'Load home';
		print_r($params);
	}
}
