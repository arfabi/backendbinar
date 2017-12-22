<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='konfirmasipembayaran';


$add               = "add";
$gettransaksi      = "gettransaksi";
$konfirm           = "konfirm";
$processkonfirmasi = "processkonfirmasi";
$detailkonfirmasi  = "detailkonfirmasi";

switch ($action)
    {
    case $add:
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $konfirm:
        $title="Konfirmasi Transaksi Pembayaran"; 
        $bank=$crud->databank();
        $data=$crud->detailpembayaran($id);
        $form_action=base_url().$controller."/processkonfirmasi";
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $detailkonfirmasi:
        $title="Detail Transaksi Pembayaran"; 
        $bank=$crud->databank();
        $data=$crud->detailkonfirmasi($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $processkonfirmasi:
        $id_transaksi     =filter_injection($_POST['id_transaksi']);
        $id_tagihan       =filter_injection($_POST['id_tagihan']);
        $jenis_pembayaran =filter_injection($_POST['jenis_pembayaran']);
        $tgl_transfer     =ubahsqltanggal(filter_injection($_POST['tgl_transfer']));
        $bank_pengirim    =filter_injection($_POST['bank_pengirim']);
        $jumlah_bayar     =filter_injection($_POST['jumlah_bayar']);
        $nama_pengirim    =filter_injection($_POST['nama_pengirim']);
        $status_konfirm   =filter_injection($_POST['status_konfirm']);

        $statuslama=$crud->cekstatuskonfirmasi($id_transaksi);
        $kekurangan=$crud->cekkekurangan($id_tagihan);
        $jumlah_bayar_lama=$crud->cekjumbayar($id_transaksi);
       
        $total_pembayaran=$crud->total_pembayaran($id_tagihan);

        
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

        if(empty($status_konfirm)){
        echo pesan_error("Anda belum memilih Status Konfirmasi");
        exit();
        }

          if(!empty($_FILES['gambar_bukti'])){
            $name = $_FILES['gambar_bukti']['name'];
            $size = $_FILES['gambar_bukti']['size'];
            $max_size=2;
            $path = "../cdn/image/pembayaran/tagihan/";
            $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg",  "PNG", "JPEG", "JPG");
            $end = explode(".", $name);
            $ext=end($end);
            if(!in_array($ext,$valid_formats)){ 
            echo pesan_error("File Foto tidak sesuai dengan Format");
            exit();
            }
            if($size>($max_size*1024000)){
            echo pesan_error("File Melebihi Batas 2 MB, Silahkan Compress ukuran Gambar, Menggunakan http://compress.photos terlebih dahulu.");
            exit();
            }
            $now=DATE("ymdHis");  
            $newname="$id_tagihan$now.$ext";
            $tmp = $_FILES['gambar_bukti']['tmp_name'];
            $upload=move_uploaded_file($tmp, $path.$newname);
             $simpan=$crud->updatekonfirm($id_transaksi, $jenis_pembayaran, $tgl_transfer, $bank_pengirim, $jumlah_bayar,$nama_pengirim,$newname,$status_konfirm);
            }else{   

            $simpan=$crud->updatekonfirmtanpagambar($id_transaksi, $jenis_pembayaran, $tgl_transfer, $bank_pengirim, $jumlah_bayar,$nama_pengirim,$status_konfirm);
            }



            if($statuslama=="M" && $status_konfirm=="Y" || $statuslama=="T" && $status_konfirm=="Y"){
            $kekurangan=$kekurangan-$jumlah_bayar;
            }else if($statuslama=="Y" && $status_konfirm=="M" || $statuslama=="Y" && $status_konfirm=="T"){
            $kekurangan=$kekurangan+$jumlah_bayar;
            }else if($statuslama=="Y" && $status_konfirm=="Y" && $jumlah_bayar!=$jumlah_bayar_lama){            
            if($jumlah_bayar_lama>$jumlah_bayar){
               $kekurangan=$kekurangan+($jumlah_bayar_lama-$jumlah_bayar);
            }else if($jumlah_bayar_lama<$jumlah_bayar){
               $kekurangan=$kekurangan-($jumlah_bayar-$jumlah_bayar_lama);
            }

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
        $url_lempar="".base_url().$controller."/detailkonfirmasi/".$id_transaksi."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }
        break;

    case $gettransaksi:
         $no_trans          =filter_injection($_POST['no_trans']);
         $nim               =filter_injection($_POST['nim']);

         if(empty($no_trans) && empty($nim)){
            echo pesan_error("Anda belum mengisi salah satu Filter diatas!");
            exit();
         }

        $data=$crud->datatransaksi($no_trans,$nim);

        if(empty($data)){
            echo pesan_error("Tidak ada transaksi yang sesuai kriteria.");
        }else{ 


          echo '<table class="table">
          <tr>
          <td><strong>No</strong></td>
          <td><strong>No. Transaksi</strong></td>
          <td><div align="center"><strong>Tanggal Pembayaran</strong></div></td>
          <td><div align="center"><strong>Pembayaran</strong></div></td>
          <td><strong>Jumlah Bayar</strong></td>
          <td><strong>Status Konfirmasi</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>';
          $no=1;
          foreach ($data as $content){
          echo '<tr>
          <td>'.$no.'</td>
          <td>'.$content['no_transaksi'].'</td>
          <td><div align="center">'.ubahtanggal($content['tgl_transfer']).'</div></td>
          <td>'.$content['nama_kategori_pembayaran'].' '.$content['nama_jenis_semester'].' '.$content['tahun_akademik'].'</td>
          <td width="15%"><div class="currency">'.number_format($content['jumlah_bayar'],2,',','.').'</div></td>
           <td>'; 

          if($content['status_konfirm']=="Y"){ echo "<span class='label label-success'>Sudah Konfirmasi</span>";}
          else if($content['status_konfirm']=="M"){ echo "<span class='label label-warning'>Menunggu Konfirmasi</span>";}
          else if($content['status_konfirm']=="T"){ echo "<span class='label label-danger'>Konfirmasi Ditolak</span>";}
          echo '
         </td>
        
          <td>
         
            
         <a class="btn btn-info" href="'.base_url().$controller.'/detailkonfirmasi/'.$content['id_transaksi'].'"><i class="fa fa-external-link"></i> Detail Transaksi</a>
         
          </td>
          </tr>';
          $no++;
          }          
          echo '</table>';
         
         }
        break;


    default:    
        $title="Konfirmasi Pembayaran"; 
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>