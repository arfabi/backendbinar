<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section             ='products';

$getproducts         = "getproducts";
$add                 = "add";
$processadd          = "processadd";
$deletekategori      = "deletekategori";
$edit        = "edit";
$processeditkategori = "processeditkategori";


switch ($action)
    {


    case $getproducts:

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $total=$crud->totalproducts($search);
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();



       // $this->db->limit($length,$start);

        $data=$crud->dataproducts($search,$length,$start);

        $start = 0;
        $nomor_urut=$start+1;
        foreach ($data as $dt) {


        $aksi="<a href='".base_url().$controller."/edit/".$dt['id_barang']."' class='btn btn-info'><i class='fa fa-edit'></i></a> <a data-href='".base_url().$controller."/hapus/".$dt['id_barang']."' class='btn btn-danger' data-toggle='modal' data-target='#confirm-hapus'><i class='fa fa-trash'></i></a>";
        
        $output['data'][]=array($nomor_urut,$dt['nama_kategori'],$dt['kd_barang'],$dt['nama_barang'],"<div class='currency'>".$dt['harga_beli']."</div>","<div class='currency'>".$dt['harga_jual']."</div>",$dt['stok'],$aksi);
        $nomor_urut++;
        }
        echo json_encode($output);
        break;

    case $edit:
        $title="Edit Produk";
        $data=$crud->detail($id);
        $form_action=base_url().$controller."/processedit";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break; 

     case $processeditkategori:
        $nama_kategori=filter_injection($_POST['nama_kategori']);
        $id_kategori=filter_injection($_POST['id_kategori']);
        $simpan=$crud->editkategori($id_kategori,$nama_kategori);

        if($simpan){
        $url_lempar="".base_url().$controller."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }

        break;

         
    case $add:
        $title="Tambah Produk Baru";
        $datakategori=$crud->getkategori();
        $form_action=base_url().$controller."/processadd";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $processadd:
        $id_kategori=filter_injection($_POST['id_kategori']);
        $kd_barang=filter_injection($_POST['kd_barang']);
        $nama_barang=filter_injection($_POST['nama_barang']);
        $harga_beli=filter_injection($_POST['harga_beli']);
        $harga_jual=filter_injection($_POST['harga_jual']);
        $stok_awal=filter_injection($_POST['stok_awal']);
        $simpan=$crud->addproducts($id_kategori,$kd_barang,$nama_barang,$harga_beli,$harga_jual,$stok_awal);

        if($simpan){
        $url_lempar="".base_url().$controller."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }

        break;

    case $deletekategori:
        $delete=$crud->deletekategori($id);
        if($delete){
            echo " <script language='javascript'>
            document.location='".base_url().$controller."/lihatkategori/SuccessDelete';
             </script>";
        }else{
            echo "<script type='text/javascript'>
             document.location='".base_url().$controller."/lihatkategori/Failed';
            </script>";
        }
        break;


    default:    
        $title="Data Produk"; 
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>