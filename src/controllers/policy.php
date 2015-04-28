<?php

class Policy extends Controller
{
	public function load($params = []){
		echo 'Load Policy';
		print_r($params);
	}
}
