          
       
         <a class="btn btn-warning btn-lg" href="<?php echo base_url();?>"><i class="fa fa-arrow-circle-left"></i> Kembali </a>

        <br/><br/>

        
        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title"> Filter Mahasiswa</h3>
                
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
               <td width="20%"><strong>Nomor Induk Mahasiswa (NIM)</strong></td>
               <td>
                   <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-credit-card"></i>
                  </div>
                <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan Nomor Induk Mahasiswa (NIM) Contoh : 5131001920">
                  </div>
                  </td>
               </tr>

                 <tr>
               <td width="20%"><strong>Nama Mahasiswa</strong></td>
               <td>
                   <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-user"></i>
                  </div>
             
                 <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" placeholder="Masukkan Nama Mahasiswa Contoh : Dimas Angga">
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
                 <?php echo pesan_error("Silahkan Gunakan Filter diatas terlebih dahulu!");?>                 
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
