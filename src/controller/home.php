<?php

class Home extends Controller
{

	// ***** Default Controller functions ***** //
		public function __construct(){

		}

		public function onAuth($params = []){
			// This page is always available!
			return true;
		}

		public function onRequest($params = []){

		}
	// **************************************** //


}
