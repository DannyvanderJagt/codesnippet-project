<?php

function redirectToPage($path = ''){
	header("Location: http://".$_SERVER['SERVER_NAME'].'/'.$path);
	exit();
}