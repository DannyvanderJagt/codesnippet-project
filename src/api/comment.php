<?php

class Comment{

	public function __construct(){
		
	}

	public function getByUser($id){
		return array('id'=>$id);
	}

}