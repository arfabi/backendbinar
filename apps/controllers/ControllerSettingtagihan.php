<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='settingtagihan';

$getsettingtagihan  = "getsettingtagihan";
$detailsetting      = "detailsetting";

$editsetting        = "editsetting";
$processeditsetting = "processeditsetting";

$deletesetting      = "deletesetting";

$addsettingtagihan  = "addsettingtagihan";
$processaddsetting  = "processaddsetting";



switch ($action)
    {
    case $detailsetting:
        $title="Detail Setting Tagihan";
        $data=$crud->detailsettingtagihan($id);
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $editsetting:
        $title="Edit Setting Tagihan";
        $data=$crud->detailsettingtagihan($id);
        $kategori=$crud->datakategoripembayaran();        
        $prodi=$crud->dataprodi();
        $angkatan=$crud->dataangkatan();
        $semester=$crud->datasemester();
        $form_action=base_url().$controller."/processeditsetting";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break; 

    case $processeditsetting:

        break;

    case $addsettingtagihan:
        $title="Tambah Setting Tagihan";
        $data=$crud->detailsettingtagihan($id);
        $kategori=$crud->datakategoripembayaran();        
        $prodi=$crud->dataprodi();
        $angkatan=$crud->dataangkatan();
        $semester=$crud->datasemester();
        $form_action=base_url().$controller."/processeditsetting";
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $processaddsetting:  
        break;

    

    case $deletesetting:
         $delete=$crud->deletesetting($id);
        if($delete){
            echo " <script language='javascript'>
            document.location='".base_url().$controller."/settingtagihan/SuccessDelete';
             </script>";
        }else{
            echo "<script type='text/javascript'>
             document.location='".base_url().$controller."/settingtagihan/Failed';
            </script>";
        }
        break;

        

    case $getsettingtagihan:
         $id_prodi    =filter_injection($_POST['id_prodi']);
         $id_angkatan =filter_injection($_POST['id_angkatan']);
         $id_semester =filter_injection($_POST['id_semester']);

         if(empty($id_prodi)){
            echo pesan_error("Anda belum memilih Prodi!");
            exit();
         }

        $data=$crud->getsettingtagihan($id_prodi,$id_angkatan,$id_semester);

        if(empty($data)){
            echo pesan_error("Tidak ada Tagihan yang sesuai kriteria.");
        }else{      

          echo '<table class="table">
          <tr>
          <td><strong>Tanggal Tagihan</strong></td>
          <td><strong>Program Studi</strong></td>
          <td><strong>Tahun Angkatan</strong></td>
          <td><strong>Pembayaran</strong></td>
          <td width="20%"><strong>Jumlah Bayar</strong></td>
          <td><strong>Status</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>';
          foreach ($data as $content){
            echo '<tr>
          <td>'.ubahtanggal2($content['tgl_generate']).'</td>
          <td>'.$content['nama_prodi'].' ('.$content['nama_jenjang'].')</td>
          <td>'.$content['tahun_angkatan'].'</td>
          <td>'.$content['nama_kategori_pembayaran'].' '.$content['nama_jenis_semester'].' '.$content['tahun_akademik'].'</td>
          <td>';

           if(empty($content['jum_sks_teori'])){ 
          echo 'Rp. '.number_format($content['jumlah_bayar'],2,',','.').'';
          }else{
          echo 'Rp. '.number_format($content['jum_sks_teori'],2,',','.').' / SKS Teori <br/>';          
          echo 'Rp. '.number_format($content['jum_sks_praktek'],2,',','.').' / SKS Praktek';
          }

          echo '
          </td>
          <td><div align="center">'; 

          if($content['status_generate']=="Y"){ echo "<span class='label label-success'>Sudah Generate</span>";}
          else if($content['status_generate']=="T"){ echo "<span class='label label-danger'>Gagal Generate</span>";}
          else if($content['status_generate']=="B"){ echo "<span class='label label-warning'>Belum Generate</span>";}
          echo '
          </div></td>
          <td>
          <a class="btn btn-info" href="'.base_url().$controller.'/detailsetting/'.$content['id_setting_tagihan'].'"><i class="fa fa-external-link"></i> Detail Setting</a>
          </td>
          </tr>';
          }          
          echo '</table>';
         
         }
        break;

    default:    
        $title="Setting Tagihan Otomatis";
        $prodi=$crud->dataprodi();
        $angkatan=$crud->dataangkatan();
        $semester=$crud->datasemester();
        $data=$crud->datasettingtagihan();
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>