<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='laporan';

$add        ="add";
$penerimaan = "penerimaan";
$piutang    = "piutang";


switch ($action)
    {
    case $add:
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $piutang:
        $title="Laporan Piutang Mahasiswa"; 
        //$prodi=$crud->dataprodi();
        //$datatagihan=$crud->detailtagihan($id);
        //$datapembayaran=$crud->datapembayarantagihan($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $penerimaan:
        $title="Laporan Penerimaan Dana"; 
        //$prodi=$crud->dataprodi();
        //$datatagihan=$crud->detailtagihan($id);
        //$datapembayaran=$crud->datapembayarantagihan($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    default:    
        $title="Laporang Keuangan"; 
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>