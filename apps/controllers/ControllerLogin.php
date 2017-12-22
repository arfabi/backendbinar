<?php


//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);



//daftar folder view di load
$section='login';
$ceklogin ="ceklogin";

switch ($action)
    {
    case $ceklogin:
            $username=filter_injection($_POST['username']);
            $password=filter_injection($_POST['password']);

        if(empty($username)){
        echo pesan_error("Mohon Masukkan Username Anda");
        exit();
        }

        if(empty($password)){
        echo pesan_error("Mohon Masukkan Password Anda");
        exit();
        }else{
        $password=enkrip($password);
        }
            $data=$crud->login($username,$password);
            if(!empty($data)){
            $url_lempar="".base_url()."dashboard";
            echo pesan_sukses_lempar('Mengalihkan ...',$url_lempar);
            }else{
           echo pesan_error('Maaf, Username atau Password Salah');
            }


    break;

    default:
        $title="Login ke Dashboard";
        $form_action="".base_url()."login/ceklogin";    
        include_once $loadview.'login.php'; 
        break;
    }
 
	
?>