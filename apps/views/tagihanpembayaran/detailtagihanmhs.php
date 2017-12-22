          
      <a class="btn btn-warning btn-lg" href="<?php echo base_url().$controller;?>"><i class="fa fa-arrow-circle-left"></i> Kembali </a>

        <br/><br/>

        
        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Data Mahasiswa</h3>
                
                <div class="box-tools">
                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">

                 <div id="tampilmhs">

                    <table class="table">
                   
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
                    <td width="30%"><strong>Jumlah Invoice</strong></td>
                    <td><?php echo $datatagihan['jum_tagihan'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Total Tagihan</strong></td>
                    <td>Rp. <?php echo number_format($datatagihan['total'],0,',','.');?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Total Pembayaran</strong></td>
                    <td>Rp. <?php $pembayaran=$datatagihan['total']-$datatagihan['total_belum'];

                    echo number_format($pembayaran,0,',','.');?></td>
                    </tr>


                    <tr>
                    <td width="30%"><strong>Sisa Kekurangan</strong></td>
                    <td>Rp. <?php echo number_format($datatagihan['total_belum'],0,',','.');?></td>
                    </tr>

                   
                    </table>
                 
                 </div>
                 
                          
                </div>  
                </div>
                </div>
        </div>
                
        

       <a class="btn btn-primary btn-lg" href="<?php echo base_url().$controller;?>/addtagihan/<?php echo $id;?>"><i class="fa fa-plus-circle"></i> Tagihan Baru </a>


        <br/><br/>

        
        
        

        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Data Tagihan Mahasiswa</h3>
                
                 <div class="box-tools">
                    <a href="<?php echo base_url().$controller;?>/cetakkwitansi/<?php echo $data['id_transaksi'];?>" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Cetak Tagihan Mahasiswa</a>
                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">

                 <div id="tampilmhs"> 
              


          <table class="table">
          <tr>
          <td width="5%"><strong>No.Invoice</strong></td>
          <td><strong>Tanggal</strong></td>
          <td><strong>Kategori Pembayaran</strong></td>
          <td><strong>Semester</strong></td>
          <td width="10%"><strong>Total Tagihan</strong></td>
          <td width="10%"><strong>Total Pembayaran</strong></td>
          <td width="10%"><strong>Sisa Kekurangan</strong></td>
          <td><strong>Status</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>


          <?php
          $no=1;
          foreach ($data as $content){
            $total=$content['total_pembayaran'];
            $belum=$content['kekurangan'];    
            $pembayaran=$total-$belum;      
          echo '<tr>
          <td><div align="center">'.$content['id_tagihan'].'</div></td>
          <td>'.ubahtanggal($content['tanggal_tagihan']).'</td>
          <td>'.$content['nama_kategori_pembayaran'].'</td>
          <td>'.$content['nama_jenis_semester'].' '.$content['tahun_akademik'].'</td>
          <td><div class="currency">'.number_format($total,2,',','.').'</div></td>
          <td><div class="currency">'.number_format($pembayaran,2,',','.').'</div></td>
          <td><div class="currency">'.number_format($belum,2,',','.').'</div></td>
          <td><div align="center">'; 

          if($content['status_tagihan']=="L"){ echo "<span class='label label-success'>Sudah Lunas</span>";}
          else if($content['status_tagihan']=="K"){ echo "<span class='label label-warning'>Masih Kurang</span>";}
          else if($content['status_tagihan']=="B"){ echo "<span class='label label-danger'>Belum Bayar</span>";}
          echo '
          </div></td>
          <td>
          <a class="btn btn-info" alt="Detail Pembayaran" href="'.base_url().$controller.'/detailpembayaran/'.$content['id_tagihan'].'"><i class="fa fa-external-link"></i> </a>
          </td>
          </tr>';
          $no++; } ?>          
          </table>
                 
                 </div>
                 
                          
                </div>  
                </div>
                </div>
        </div>
                

                   




<script type="text/javascript">

jQuery('#cek_makul').click(function() { 

     $("#tampilmhs").html("<div align='center'><img src='<?php echo base_url();?>public/spinner.gif' width='50' height='50' align='center' /></div>");

       var id_prodi          =jQuery("#id_prodi").val();
       var nama_mhs          =jQuery("#nama_mhs").val();
       var nim               =jQuery("#nim").val();
    
        jQuery.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '<?php echo base_url().$controller;?>/getmahasiswa', // File pemroses data
            data: 'id_prodi=' + id_prodi+ '&nama_mhs=' + nama_mhs+'&nim=' + nim, // Data yang akan dikirim ke file pemroses
            success: function(response) { // Jika berhasil
                $("#tampilmhs").html(response); 
                console.log(response);

            }
        });

        
      
    });


</script>

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
