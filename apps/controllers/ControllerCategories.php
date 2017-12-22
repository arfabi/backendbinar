<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='categories';

$getproducts         = "getproducts";
$add                 = "add";
$processaddkategori  = "processaddkategori";
$hapus               = "hapus";
$edit                = "edit";
$processeditkategori = "processeditkategori";


switch ($action)
    {


    case $getproducts:

        $draw=$_REQUEST['draw'];
        $length=$_REQUEST['length'];
        $start=$_REQUEST['start'];
        $search=$_REQUEST['search']["value"];
        $total=$crud->totalkategori($search);
        $output=array();
        $output['draw']=$draw;
        $output['recordsTotal']=$output['recordsFiltered']=$total;
        $output['data']=array();



       // $this->db->limit($length,$start);

        $data=$crud->datakategori($search,$length,$start);

        $start = 0;
        $nomor_urut=$start+1;
        foreach ($data as $dt) {
            if($dt['status_kategori']=="A"){
                $status="<span class='badge bg-green'>Aktif</span>";
            }else if($dt['status_kategori']=="T"){
                $status="<span class='badge bg-yellow'>Tidak Aktif</span>";
            }else{
                $status="<span class='badge bg-red'>Dihapus</span>";
            }


            $aksi="<a href='".base_url().$controller."/edit/".$dt['id_kategori']."' class='btn btn-info'><i class='fa fa-edit'></i> Edit</a>
                    <a data-href='".base_url().$controller."/hapus/".$dt['id_kategori']."' class='btn btn-danger' data-toggle='modal' data-target='#confirm-hapus'><i class='fa fa-trash'></i> Delete</a>";

            $output['data'][]=array($nomor_urut,$dt['nama_kategori'],$status,$aksi);
        $nomor_urut++;
        }
        echo json_encode($output);
        break;

    case $edit:
        $title="Edit Kategori Produk";
        $data=$crud->detailkategori($id);
        $form_action=base_url().$controller."/processeditkategori";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break; 

     case $processeditkategori:
        $nama_kategori=filter_injection($_POST['nama_kategori']);
        $id_kategori=filter_injection($_POST['id_kategori']);
        $status_kategori=filter_injection($_POST['status']);
        $simpan=$crud->editkategori($id_kategori,$nama_kategori,$status_kategori);

        if($simpan){
        $url_lempar="".base_url().$controller."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }

        break;

         
    case $add:
        $title="Tambah Kategori Produk";
        $form_action=base_url().$controller."/processaddkategori";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $path_action;       
        //include_once $loadview.'usertemplate.php'; 
        break;

    case $processaddkategori:
        $nama_kategori=filter_injection($_POST['nama_kategori']);
        $status=filter_injection($_POST['status']);
        $simpan=$crud->addkategori($nama_kategori,$status);

        if($simpan){
        $url_lempar="".base_url().$controller."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }

        break;

    case $hapus:
        $delete=$crud->deletekategori($id);
        if($delete){
            echo " <script language='javascript'>
            document.location='".base_url().$controller."/SuccessDelete';
             </script>";
        }else{
            echo "<script type='text/javascript'>
             document.location='".base_url().$controller."/Failed';
            </script>";
        }
        break;


    default:    
        $title="Data Kategori"; 
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>