<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='dashboard';

$add    ="add";


switch ($action)
    {
    case $add:
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'template.php'; 
        break;

    default:    
        $title="Dashboard";  
   

        $path_action=$loadview.$section.'/home.php';        
        include_once $loadview.'usertemplate.php'; 
        break;
    }

 
	
?>