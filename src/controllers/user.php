<?php

class User extends Controller
{
	public function load($params = []){
		echo 'Load User';
		print_r($params);
	}
}
