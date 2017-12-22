<?php


if($_SESSION['level']=="USER"){
$url=base_url()."user";
header("location:".$url.""); 
}else if($_SESSION['level']=="Owner"){
$url=base_url()."dashboard";
header("location:".$url.""); 
}else{
$url=base_url()."login";
header("location:".$url.""); 
}
 
	
?>