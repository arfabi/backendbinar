<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='konfirmcash';

$add                  = "add";
$gettagihan           = "gettagihan";
$addkonfirmcash       = "addkonfirmcash";
$processaddkonfirmasi = "processaddkonfirmasi";
$detailpembayaran     = "detailpembayaran";


switch ($action)
    {
    case $add:
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $addkonfirmcash:        
        $title="Bayar Tagihan Secara Cash"; 
        $bank=$crud->databank();
        $data=$crud->detailtagihan($id);
        $form_action=base_url().$controller."/processaddkonfirmasi";
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php';
        break;

    case $processaddkonfirmasi:
        $id_tagihan       =filter_injection($_POST['id_tagihan']);
        $jenis_pembayaran =filter_injection($_POST['jenis_pembayaran']);
        $tgl_transfer     =ubahsqltanggal(filter_injection($_POST['tgl_transfer']));
        $bank_pengirim    =filter_injection($_POST['bank_pengirim']);
        $jumlah_bayar     =filter_injection($_POST['jumlah_bayar']);
        $nama_pengirim    =filter_injection($_POST['nama_pengirim']);
        $status_konfirm   ="Y";
        
        $kekurangan       =$crud->cekkekurangan($id_tagihan);       
        $total_pembayaran =$crud->total_pembayaran($id_tagihan);

        
        if(empty($nama_pengirim)){
        echo pesan_error("Nama Pengirim Harus diisi!");
        exit();
        }
        if(empty($tgl_transfer)){
        echo pesan_error("Tanggal Transfer Harus diisi!");
        exit();
        }
        if(empty($bank_pengirim)){
        echo pesan_error("Bank Pengirim Harus dipilih!");
        exit();
        }
        if(empty($jumlah_bayar)){
        echo pesan_error("Jumlah Transfer Harus diisi!");
        exit();
        }


        $now=DATE("ymdHis"); 
        $no_transaksi="$id_tagihan$now";

        $simpan=$crud->simpankonfirm($no_transaksi, $id_tagihan, $jenis_pembayaran, $nama_pengirim, $tgl_transfer, $bank_pengirim, $jumlah_bayar,$status_konfirm);



            if($status_konfirm=="Y"){
            $kekurangan=$kekurangan-$jumlah_bayar;
            }
           

            if($kekurangan==0){
              $status_tagihan="L";
            }else if($kekurangan==$total_pembayaran){
              $status_tagihan="B";
            }else if($kekurangan>0 && $kekurangan!=$total_pembayaran){
              $status_tagihan="K";
            }

 

        $updatetagihan=$crud->updatetagihan($id_tagihan,$status_tagihan,$kekurangan);

        if($simpan && $updatetagihan){
        $url_lempar="".base_url().$controller."/detailpembayaran/".$no_transaksi."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }
        break;

    case $detailpembayaran:
        $title="Detail Pembayaran Cash"; 
        $data=$crud->detailpembayaran($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php';
        break;

    case $gettagihan:
         $id_prodi =filter_injection($_POST['id_prodi']);
         $nama     =filter_injection($_POST['nama_mhs']);
         $nim      =filter_injection($_POST['nim']);

         if(empty($id_prodi)){
            echo pesan_error("Anda belum memilih Program Studi!");
            exit();
         }

          if(empty($nama) && empty($nim)){
            echo pesan_error("Anda harus mengisi salah satu Nama atau NIM Mahasiswa!");
            exit();
         }

        $data=$crud->datatagihanmahasiswa($nama,$nim,$id_prodi);

        if(empty($data)){
            echo pesan_error("Tidak ada Tagihan untuk Mahasiswa ini.");
        }else{      

          echo '<table class="table">
          <tr>
          <td><strong>No</strong></td>
          <td><strong>NIM</strong></td>
          <td width="15%"><strong>Nama Lengkap</strong></td>
          <td><strong>Tanggal Tagihan</strong></td>
          <td><strong>Kategori Pembayaran</strong></td>
          <td width="10%"><strong>Total Tagihan</strong></td>
          <td width="10%"><strong>Tagihan Belum Dibayar</strong></td>
          <td><div align="center"><strong>Aksi</strong></div></td>
          </tr>';
          $no=1;
          foreach ($data as $content){
            $total=$content['total_pembayaran'];
            $belum=$content['kekurangan'];
          echo '<tr>
          <td>'.$no.'</td>
          <td>'.$content['nim'].'</td>
          <td>'.$content['nama_lengkap'].'</td>
          <td>'.ubahtanggal($content['tanggal_tagihan']).'</td>
          <td>'.$content['nama_kategori_pembayaran'].' '.$content['nama_jenis_semester'].' '.$content['tahun_akademik'].'</td>
          <td width="15%"><div class="currency">'.number_format($total,2,',','.').'</div></td>
          <td width="15%"><div class="currency">'.number_format($belum,2,',','.').'</div></td>
          <td>
          <a class="btn btn-info" href="'.base_url().$controller.'/addkonfirmcash/'.$content['id_tagihan'].'"><i class="fa fa-plus-circle"></i> Bayar Tagihan</a>
          </td>
          </tr>';
          $no++;
          }          
          echo '</table>';
         
         }
        break;
    default:    
        $title="Pembayaran Cash"; 
        $prodi=$crud->dataprodi();
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>