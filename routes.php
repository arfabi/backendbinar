<?php 

/*
@Ahmad Ridlo Fadli, 02 September 2016
 */

	$path='apps/controllers/Controller'.ucfirst($controller).'.php';
    if (file_exists($path))  {
    	//Active Controller
    	$loadview ='apps/views/';
    	$getview  ='apps/views/theme/';
    	$getmodel ='apps/models/Model';
		include_once $path;		
		} else {
		include "404.php";
		}

?>