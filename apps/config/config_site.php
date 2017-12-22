<?php
//Setting for show error log
/**
 http://stackoverflow.com/questions/5438060/showing-all-errors-and-warnings
 @Toto Raharjo, 3 September 2016 [kerjaremote@gmail.com]
 */
error_reporting(E_ALL);
ini_set('display_errors', 1); // 1: Development 0: Launching


date_default_timezone_set('Asia/Jakarta');
$datenow    =date('Y-m-d H:i:s');


function base_url(){  
    static $url_base    ='http://localhost:8080/erdelabs/aksapos/';
    return $url_base;
}

function cdn_url(){  
    static $url_base='http://localhost:8080/erdelabs/aksapos/public/images/';
    return $url_base;
}

function asset_url(){
    $url_asset      =base_url().'assets/';
    return $url_asset;
}


function con_url(){
    $url_controller      =base_url().$controller.'/';
    return $url_controller;
}

function site_title(){
    $site_title      ="AksaPos - Aplikasi Kasir & Penjualan Online";
    return $site_title;
}

function site_tagline(){
    $site_title      ="Aplikasi Kasir & Penjualan Online";
    return $site_title;
}

function site_title_small(){
    $site_title      ="AksaPos";
    return $site_title;
}




function Terbilang($x)
{
  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . " Belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " Puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " Ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " Ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " Juta" . Terbilang($x % 1000000);
}



?>