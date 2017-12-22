          
       
        
        <div class="row">             
        
                <div class="col-md-12">

                
              <div class="callout callout-info">
                <h4><i class="icon fa fa-info-circle"></i> Informasi!</h4>
                Setting Tagihan berfungsi untuk membuat tagihan pembayaran otomatis kepada Mahasiswa pada tanggal tertentu.
              </div>

                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Cari Setting Tagihan</h3>
                
                <div class="box-tools">
                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">
                   <table class="table">
               <tr>
               <td width="20%"><strong>Program Studi</strong></td>
               <td>
                   <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-user-plus"></i>
                  </div>
                  <select name="id_prodi" id="id_prodi" class="form-control" name="id_prodi">
                    <option value="">Pilih Program Studi</option>
                    <?php foreach($prodi as $content){
                      echo '<option value="'.$content['id_prodi'].'">'.$content['nama_prodi'].' - '.$content['nama_jenjang'].'</option>';
                    }
                    ?>
                  </select>
                  </div>
                  </td>
                  <td colspan="5" width="30%">
                  </td>
               </tr>

               
                <tr>
               <td width="20%"><strong>Tahun Angkatan</strong></td>
               <td>
                   <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-line-chart"></i>
                  </div>
                 <select name="id_angkatan" id="id_angkatan" class="form-control" name="id_prodi">
                    <option value="">Pilih Tahun Angkatan</option>
                    <?php foreach($angkatan as $cangkatan){
                      echo '<option value="'.$cangkatan['id_tahun_akademik'].'">'.$cangkatan['tahun_akademik'].'</option>';
                    }
                    ?>
                  </select>
                  </div>
                  </td>
               </tr>

                 <tr>
               <td width="20%"><strong>Semester</strong></td>
               <td>
                   <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-book"></i>
                  </div>
             
                <select name="id_semester" id="id_semester" class="form-control" name="id_prodi">
                    <option value="">Pilih Semester</option>
                    <?php foreach($semester as $datasemester){
                      echo '<option value="'.$datasemester['id_semester'].'">'.$datasemester['nama_jenis_semester'].' - '.$datasemester['tahun_akademik'].'</option>';
                    }
                    ?>
                  </select>
                  </div>
                  </td>
               </tr>
                <tr>
               <td width="20%"></td>
               <td>
                <button id="cek_makul" class="btn btn-primary"><i class="fa fa-search"></i> Tampilkan</button>
                  </td>
               </tr>
              
               </table>
                 
                          
                </div>  
                </div>
                </div>
        </div>
        
        <a class="btn btn-primary btn-lg" href="<?php echo base_url().$controller;?>/addsettingtagihan"><i class="fa fa-plus-circle"></i> Setting Tagihan Baru </a>
         <a class="btn btn-warning btn-lg" href="<?php echo base_url();?>"><i class="fa fa-arrow-circle-left"></i> Kembali </a>

        <br/><br/>


        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Data Setting Tagihan</h3>
                
                <div class="box-tools">
                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">



                 <div id="tampilmhs"> 
                 <?php if(empty($data)){ 
                  echo pesan_error("Setting Tagihan tidak ada, Silahkan buat Setting Tagihan Baru!");
                  }else{

                  ?>   

           
          <table class="table">
          <tr>
          <td><strong>Tanggal Tagihan</strong></td>
          <td><strong>Program Studi</strong></td>
          <td><strong>Tahun Angkatan</strong></td>
          <td><strong>Pembayaran</strong></td>
          <td width="20%"><strong>Jumlah Bayar</strong></td>
          <td><strong>Status</strong></td>
          <td><strong>Aksi</strong></td>
          </tr>




          <?php
          $no=1;
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
          $no++; } ?>          
          </table>
          
          <?php } ?>
                 </div>
                 
                          
                </div>  
                </div>
                </div>
        </div>
                

                   




<script type="text/javascript">

jQuery('#cek_makul').click(function() { 

     $("#tampilmhs").html("<div align='center'><img src='<?php echo base_url();?>public/spinner.gif' width='50' height='50' align='center' /></div>");

       var id_prodi    =jQuery("#id_prodi").val();
       var id_angkatan =jQuery("#id_angkatan").val();
       var id_semester =jQuery("#id_semester").val();
       
        jQuery.ajax({
            type: 'POST', // Metode pengiriman data menggunakan POST
            url: '<?php echo base_url().$controller;?>/getsettingtagihan', // File pemroses data
            data: 'id_prodi=' + id_prodi+ '&id_semester=' + id_semester+'&id_angkatan=' + id_angkatan, // Data yang akan dikirim ke file pemroses
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
