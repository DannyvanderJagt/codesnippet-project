<?php

function redirectToPage($path = ''){
	header("Location: ".DOMAIN.'/'.$path);
	exit();
}