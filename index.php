<?php
session_start();
require_once 'apps/config/config_db.php';
require_once 'apps/config/config_site.php';
require_once 'apps/config/function_security.php';
require_once 'apps/config/function_tanggal.php';
require_once 'apps/config/function_pagination.php';
require_once 'apps/config/function_session.php';
require_once 'apps/config/function_uuid_generate.php';

$get_contr   = filter_injection($_GET['contr']);
$get_act	 = filter_injection($_GET['act']);
$get_id      = filter_injection($_GET['id']);

if (empty($get_contr)) 
	{ $get_contoller='home'; } 
		else { $get_contoller=$get_contr; }

$controller= $get_contoller;
$action    = $get_act;
$id 	   = $get_id;


/*
echo '$controller : '.$controller;
echo '<br>$action : '.$action;
echo '<br>$id     : '.$id;  
*/
require_once 'routes.php';


dsfdasfdasfasf

?>