<?php

//Cek Sesi Admin
cek_sesi_admin($controller);



//Memanggil Model
$path_model=$getmodel.ucfirst($controller).'.php';
include_once $path_model;
$crud = new crud($DB_con);


//daftar folder view di load
$section='tagihanpembayaran';

$add                  ="add";
$getmahasiswa         = "getmahasiswa";

$addtagihan           = "addtagihan";
$processaddtagihan    = "processaddtagihan";
$detailtagihanmhs     ="detailtagihanmhs";
$detailpembayaran     = "detailpembayaran";
$detailtransaksi     = "detailtransaksi";

$konfirmasipembayaran = "konfirmasipembayaran";
$processkonfirmasi    = "processkonfirmasi";
$addkonfirmasi        = "addkonfirmasi";
$processaddkonfirmasi = "processaddkonfirmasi";


switch ($action)
    {
    case $add:
        $path_action=$loadview.$section.'/'.$action.'.php';        
        include_once $loadview.'usertemplate.php'; 
        break;

    case $detailtagihanmhs:
        $title="Tagihan Per Mahasiswa"; 
        $prodi=$crud->dataprodi();
        $data=$crud->datatagihanmahasiswa($id);
        $datatagihan=$crud->infotagihanmahasiswa($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $addtagihan:
        $title="Tambah Tagihan Manual"; 
        $kategori=$crud->datakategoripembayaran();
        $datamahasiswa=$crud->infomahasiswa($id);
        $form_action=base_url().$controller."/processaddtagihan";
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $processaddtagihan:
        $id_mahasiswa           =filter_injection($_POST['id_mahasiswa']);
        $id_kategori_pembayaran =filter_injection($_POST['id_kategori_pembayaran']);
        $tanggal_tagihan        =ubahsqltanggal(filter_injection($_POST['tanggal_tagihan']));
        $id_semester            =$crud->ceksemesteraktif();
        $total_pembayaran       =filter_injection($_POST['total_pembayaran']);
        $kekurangan             =$total_pembayaran;
        $status_tagihan         ="B";

        
        if(empty($id_kategori_pembayaran)){
        echo pesan_error("Silahkan Pilih Kategori Pembayaran!");
        exit();
        }
        if(empty($tanggal_tagihan)){
        echo pesan_error("Tanggal Tagihan Harus diisi!");
        exit();
        }
        if(empty($total_pembayaran)){
        echo pesan_error("Total Pembayaran Harus Diisi!");
        exit();
        }


        $simpan=$crud->addtagihan($id_mahasiswa, $id_kategori_pembayaran, $id_semester, $tanggal_tagihan, $total_pembayaran, $kekurangan, $status_tagihan);

        if($simpan){
        $url_lempar="".base_url().$controller."/detailtagihanmhs/".$id_mahasiswa."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }
        break;

    case $konfirmasipembayaran:
        $title="Konfirmasi Pembayaran Tagihan"; 
        $bank=$crud->databank();
        $data=$crud->detailpembayaran($id);
        $form_action=base_url().$controller."/processkonfirmasi";
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php';
        break;
    case $detailtransaksi:
        $title="Detail Pembayaran"; 
        $bank=$crud->databank();
        $data=$crud->detailkonfirmasi($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    case $addkonfirmasi:
        $title="Tambah Transaksi Pembayaran"; 
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
        $status_konfirm   =filter_injection($_POST['status_konfirm']);
        
        $kekurangan=$crud->cekkekurangan($id_tagihan);       
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
            $no_transaksi=$now;
            $newname="$id_tagihan$now.$ext";
          
            $tmp = $_FILES['gambar_bukti']['tmp_name'];
            $upload=move_uploaded_file($tmp, $path.$newname);
            }else{
            $newname="";
            $now=DATE("ymdHis");  
            $no_transaksi="$id_tagihan$now";
            }

            $simpan=$crud->simpankonfirm($no_transaksi, $id_tagihan, $jenis_pembayaran, $nama_pengirim, $tgl_transfer, $bank_pengirim, $jumlah_bayar, $newname, $status_konfirm);



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
        $url_lempar="".base_url().$controller."/detailpembayaran/".$id_tagihan."";
        echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }
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
        $url_lempar="".base_url().$controller."/detailpembayaran/".$id_tagihan."";
       // echo "sukses";
       echo pesan_sukses_lempar('Data Berhasil Disimpan, Mengalihkan . . .',$url_lempar);
        }else{
        echo pesan_error("Data Gagal Disimpan!");
        }
       

        break;

    case $detailpembayaran:
        $title="History Pembayaran Tagihan"; 
        $prodi=$crud->dataprodi();
        $datatagihan=$crud->detailtagihan($id);
        $datapembayaran=$crud->datapembayarantagihan($id);
        $path_action=$loadview.$section.'/'.$action.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;

    case $getmahasiswa:
         $id_prodi          =filter_injection($_POST['id_prodi']);
         $nama_mhs          =filter_injection($_POST['nama_mhs']);
         $nim               =filter_injection($_POST['nim']);

         if(empty($id_prodi)){
            echo pesan_error("Anda belum memilih Program Studi!");
            exit();
         }

        $data=$crud->datamahasiswa($id_prodi,$nama_mhs,$nim);

        if(empty($data)){
            echo pesan_error("Tidak ada mahasiswa yang sesuai kriteria.");
        }else{      

          echo '<table class="table">
          <tr>
          <td><strong>No</strong></td>
          <td><strong>NIM</strong></td>
          <td><strong>Nama Lengkap</strong></td>
          <td><strong>Total Tagihan</strong></td>
          <td><strong>Total Pembayaran</strong></td>
          <td><strong>Sisa Kekurangan</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>';
          $no=1;
          foreach ($data as $content){
            $total=$content['total'];
            $belum=$content['total_belum'];
            $pembayaran=$total-$belum;
          echo '<tr>
          <td>'.$no.'</td>
          <td>'.$content['nim'].'</td>
          <td>'.$content['nama_lengkap'].'</td>
          <td width="15%"><div class="currency">'.number_format($total,2,',','.').'</div></td>
          <td width="15%"><div class="currency">'.number_format($pembayaran,2,',','.').'</div></td>
          <td width="15%"><div class="currency">'.number_format($belum,2,',','.').'</div></td>
          <td>
          <a class="btn btn-info" href="'.base_url().$controller.'/detailtagihanmhs/'.$content['id_mahasiswa'].'"><i class="fa fa-external-link"></i> Lihat Detail</a>
          </td>
          </tr>';
          $no++;
          }          
          echo '</table>';
         
         }
        break;

    default:    
        $title="Data Tagihan"; 
        $prodi=$crud->dataprodi();
        $path_action=$loadview.$section.'/'.$controller.'.php';       
        include_once $loadview.'usertemplate.php'; 
        break;
    }

?>