          
     
         <a class="btn btn-warning btn-lg" href="<?php echo base_url().$controller;?>/detailtagihanmhs/<?php echo $datatagihan['id_mahasiswa'];?>"><i class="fa fa-arrow-circle-left"></i> Kembali </a>

        <br/><br/>

        
        
        

        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Data Tagihan</h3>
                
                
                </div>
                <!-- /.box-header -->
                
                <div class="box-body">

                 <div id="tampilmhs">

                    <table class="table">
                    <tr>
                    <td width="30%"><strong>No. Invoice</strong></td>
                    <td><strong>#<?php echo $datatagihan['id_tagihan'];?></strong></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Nama Mahasiswa</strong></td>
                    <td><?php echo $datatagihan['nama_lengkap'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>NIM</strong></td>
                    <td><?php echo $datatagihan['nim'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Program Studi</strong></td>
                    <td><?php echo $datatagihan['nama_prodi'];?> (<?php echo $datatagihan['nama_jenjang'];?>)</td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Kategori Pembayaran</strong></td>
                    <td><?php echo $datatagihan['nama_kategori_pembayaran'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Semester</strong></td>
                    <td><?php echo $datatagihan['nama_jenis_semester'];?> <?php echo $datatagihan['tahun_akademik'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Tanggal Tagihan</strong></td>
                    <td><?php echo ubahtanggal($datatagihan['tanggal_tagihan']);?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Total Tagihan</strong></td>
                    <td>Rp. <?php echo number_format($datatagihan['total_pembayaran'],2,',','.');?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Total Pembayaran</strong></td>
                    <td>Rp. 
                    <?php $pembayaran=$datatagihan['total_pembayaran']-$datatagihan['kekurangan'];
                    echo number_format($pembayaran,2,',','.');?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Sisa Kekurangan</strong></td>
                    <td>Rp. <?php echo number_format($datatagihan['kekurangan'],2,',','.');?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Status</strong></td>
                    <td>
                    <?php
                        if($datatagihan['status_tagihan']=="L"){ echo "<span class='label label-success'>Sudah Lunas</span>";}
                        else if($datatagihan['status_tagihan']=="K"){ echo "<span class='label label-warning'>Masih Kurang</span>";}
                        else if($datatagihan['status_tagihan']=="B"){ echo "<span class='label label-danger'>Belum Bayar</span>";}  

                        ?>

                    </td>
                    </tr>
                    </table>
                 
                 </div>
                 
                          
                </div>  
                </div>
                </div>
        </div>
                
  
        <a class="btn btn-primary btn-lg" href="<?php echo base_url().$controller;?>/addkonfirmasi/<?php echo $id;?>"><i class="fa fa-plus-circle"></i> Pembayaran Baru </a>
        <br/><br/>


        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Data Pembayaran</h3>
                
                <div class="box-tools">
                    <a href="<?php echo base_url().$controller;?>/cetakkwitansi/<?php echo $data['id_transaksi'];?>" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak Rekap Pembayaran</a>
                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">

                 <div id="tampilmhs"> 
              

          <table class="table">
          <tr>
          <td><strong>No.</strong></td>
          <td><strong>No. Transaksi</strong></td>
          <td><strong>Tanggal</strong></td>
          <td><strong>Jenis Pembayaran</strong></td>
          <td><strong>Penyetor</strong></td>
          <td><strong>Bank</strong></td>
          <td><strong>Jumlah Bayar</strong></td>
          <td><strong>Status Pembayaran</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>

          <?php if(empty($datapembayaran)){?>
          <tr>
          <td colspan="9">
          <?php echo pesan_error("Tidak ditemukan riwayat pembayaran untuk tagihan ini.");?>
          </td>
          </tr> 
          <?php } ?>


          <?php
          $no=1;
          foreach ($datapembayaran as $content){
          echo '<tr>
          <td>'.$no.'</td>
          <td>'.$content['no_transaksi'].'</td>
          <td>'.ubahtanggal($content['tgl_transfer']).'</td>
          <td>'.$content['jenis_pembayaran'].'</td>
          <td>'.$content['nama_pengirim'].' </td>
          <td>'.$content['nama_bank'].' </td>
          <td><div class="currency">'.number_format($content['jumlah_bayar'],2,',','.').'</div></td>
          <td><div align="center">'; 

          if($content['status_konfirm']=="Y"){ echo "<span class='label label-success'>Sudah Konfirmasi</span>";}
          else if($content['status_konfirm']=="M"){ echo "<span class='label label-warning'>Menunggu Konfirmasi</span>";}
          else if($content['status_konfirm']=="T"){ echo "<span class='label label-danger'>Konfirmasi Ditolak</span>";}
          echo '
          </div></td>
          <td>
          <a class="btn btn-info" href="'.base_url().$controller.'/detailtransaksi/'.$content['id_transaksi'].'"><i class="fa fa-external-link"></i> Detail Transaksi</a>
          </td>
          </tr>';
          $no++; } ?>          
          </table>
                 
                 </div>
                 
                          
                </div>  
                </div>
                </div>
        </div>
                

                   



<style>

.currency {
   text-align: right;
   width: 100%;
}

.currency:before {
   content: "Rp.";
   float: left;
}
</style>
