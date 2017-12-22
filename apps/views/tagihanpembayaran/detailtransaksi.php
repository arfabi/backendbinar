<br/>
<br/>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css">


<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
     

    <div class="row">
    <div class="col-md-1 col-xs-0">
    </div>
    <div class="col-md-10 col-xs-12">
<div class="box box-danger">


<div class="box-header">
<h3 class="box-title">Detail Pembayaran</h3>
</div>
<div class="box-body">

<form id="form_submit" name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">



 <table class="table">

        




            <tr>
                <td width="30%"><strong>Tagihan</strong>
                </td>
                <td>
                    #<?php echo $data['id_tagihan'];?> - <?php echo $data['nama_kategori_pembayaran'];?> <?php echo $data['nama_jenis_semester'];?> <?php echo $data['tahun_akademik'];?>
                </td>
            </tr>

            <tr>
                <td width="30%"><strong> Mahasiswa</strong>
                </td>
                <td>
                   <?php echo $data['nama_lengkap'];?> (<?php echo $data['nama_prodi'];?> - <?php echo $data['nama_jenjang'];?>)                  
                </td>
            </tr>

             <tr>
                <td width="30%"><strong> Nomor Transaksi</strong>
                </td>
                <td>
                   <?php echo $data['no_transaksi'];?> 
                </td>
            </tr>

               <tr>
                <td width="30%"><strong> Metode Pembayaran</strong>
                </td>
               <td>
                   <?php echo $data['jenis_pembayaran'];?>
                
                </td>
            </tr>


            <tr>
                <td width="30%"><strong> Atas Nama Pengirim / Penyetor</strong>
                </td>
                <td><?php echo $data['nama_pengirim'];?>

                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Setor</strong></td>
                <td>  <?php echo ubahtanggal($data['tgl_transfer']);?></td>
            </tr>
            <tr>
                <td><strong>Bank Pengirim</strong></td>
                <td><?php echo $data['nama_bank'];?></td>
            </tr>
            <tr>
                <td><strong>Jumlah Transfer</strong></td>
                <td>Rp. <?php echo number_format($data['jumlah_bayar'],2,',','.');?></td>
            </tr>
            <tr>
                
                <td><strong>Upload Bukti Pembayaran</strong></td>
                <td>
                <?php if(!empty($data['gambar_bukti'])){ ?>
              
                <ul class="mailbox-attachments clearfix">
                 <li>
                  <span class="mailbox-attachment-icon has-img"><img src="<?php echo cdn_url();?>pembayaran/tagihan/<?php echo $data['gambar_bukti'];?>" alt="404"></span>

                  <div class="mailbox-attachment-info">
                    <a href="<?php echo cdn_url();?>pembayaran/tagihan/<?php echo $data['gambar_bukti'];?>" target="_BLANK" class="mailbox-attachment-name"><i class="fa fa-camera"></i> <?php echo $data['gambar_bukti'];?></a>
                        <span class="mailbox-attachment-size">
                          1 MB
                          <a href="<?php echo cdn_url();?>pembayaran/tagihan/<?php echo $data['gambar_bukti'];?>" target="_BLANK" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                </ul>

                <?php } ?>
                    
                   


                </td>
            </tr>

              <tr>
                <td><strong>Status</strong></td>
                <td>

                <?php                
                if($data['status_konfirm']=="Y"){ echo "<span class='label label-success'>Sudah Konfirmasi</span>";}
                else if($data['status_konfirm']=="M"){ echo "<span class='label label-warning'>Menunggu Konfirmasi</span>";}
                else if($data['status_konfirm']=="T"){ echo "<span class='label label-danger'>Konfirmasi Ditolak</span>";}                
                ?>

                </td>
            </tr>
           
       
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">
                  <?php echo '
                      <a class="btn btn-primary btn-lg" href="'.base_url().$controller.'/konfirmasipembayaran/'.$data['id_transaksi'].'"><i class="fa fa-check-square"></i> Konfirmasi</a> ';?>
                       
                        <a href="<?php echo base_url().$controller;?>/cetakkwitansi/<?php echo $data['id_transaksi'];?>" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-print"></i> Cetak Bukti</a>

                        <a href="<?php echo base_url().$controller;?>/detailpembayaran/<?php echo $data['id_tagihan'];?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
                        </div>

                        </form>
                   
</div>
</div>
</div>
<div class="col-md-2 col-xs-0">
</div>
</div>