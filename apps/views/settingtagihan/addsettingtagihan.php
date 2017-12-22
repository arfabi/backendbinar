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
<h3 class="box-title">Tambah Setting Tagihan</h3>
</div>
<div class="box-body">

<form id="form_submit" name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">



 <table class="table">

        


            <tr>
                <td width="30%"><strong>Kategori Pembayaran</strong>
                </td>
                <td>

                    <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-check-o"></i>
                        </div>
                       <select name="id_kategori_pembayaran" id="id_kategori_pembayaran" class="form-control" name="id_prodi">
                    <option value="">Pilih Kategori Pembayaran</option>
                    <?php foreach($kategori as $datakategori){
                      echo '<option value="'.$datakategori['id_kategori_pembayaran'].'"'; if($data['id_kategori_pembayaran']==$datakategori['id_kategori_pembayaran']){ echo "Selected"; } echo '>'.$datakategori['nama_kategori_pembayaran'].'</option>';
                    }
                    ?>
                  </select>
                        </div>
                        </div>


                </td>
            </tr>

              <tr>
                <td width="30%"><strong> Semester</strong>
                </td>
               <td>
                  <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-book"></i>
                  </div>
             
                <select name="id_semester" id="id_semester" class="form-control" name="id_prodi">
                    <option value="">Pilih Semester</option>
                    <?php foreach($semester as $datasemester){
                      echo '<option value="'.$datasemester['id_semester'].'"';  if($data['id_semester']==$datasemester['id_semester']){ echo "Selected"; } echo '>'.$datasemester['nama_jenis_semester'].' - '.$datasemester['tahun_akademik'].'</option>';
                    }
                    ?>
                  </select>
                  </div>
                
                </td>
            </tr>


            <tr>
                <td width="30%"><strong>Tanggal Tagihan</strong>
                </td>
                <td>

                    <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-check-o"></i>
                        </div>
                       <input type="text" name="tgl_generate" class="form-control" id="tgl_generate" value="<?php if(!empty($data['tgl_generate'])){ echo ubahtanggal($data['tgl_generate']);}?>" placeholder="Masukkan Tanggal Cth. 15/02/2017">
                        </div>
                        </div>


                </td>
            </tr>

            <tr>
                <td width="30%"><strong> Program Studi</strong>
                </td>
                <td>

                <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-user-plus"></i>
                  </div>
                  <select name="id_prodi" id="id_prodi" class="form-control" name="id_prodi">
                    <option value="">Pilih Program Studi</option>
                    <?php foreach($prodi as $content){
                      echo '<option value="'.$content['id_prodi'].'"';  if($data['id_prodi']==$content['id_prodi']){ echo "Selected"; } echo '>'.$content['nama_prodi'].' - '.$content['nama_jenjang'].'</option>';
                    }
                    ?>
                  </select>
                  </div>

                </td>
            </tr>

             <tr>
                <td width="30%"><strong> Tahun Angkatan</strong>
                </td>
                <td>

                     <div class="input-group">
                  <div class="input-group-addon">
                  <i class="fa fa-line-chart"></i>
                  </div>
                 <select name="id_angkatan" id="id_angkatan" class="form-control" name="id_prodi">
                    <option value="">Pilih Tahun Angkatan</option>
                    <?php foreach($angkatan as $cangkatan){
                      echo '<option value="'.$cangkatan['id_tahun_akademik'].'"';  if($data['id_angkatan']==$cangkatan['id_tahun_akademik']){ echo "Selected"; } echo '>'.$cangkatan['tahun_akademik'].'</option>';
                    }
                    ?>
                  </select>
                  </div>

                </td>
            </tr>

             
            
      
                <tr id="nonsks" style="display: <?php if($data['id_kategori_pembayaran']=="2"){echo "none";}?>;">
                <td width="30%"><strong> Jumlah Bayar</strong>
                </td>
                <td>


                      <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                       <input type="text" name="jumlah_bayar" class="form-control" id="jumlah_bayar" value="<?php echo $data['jumlah_bayar'];?>" placeholder="Masukkan Jumlah Bayar Contoh : 50000">
                        <div class="input-group-addon">
                        ,00
                        </div>
                        </div>
                        </div>


                </td>
            </tr>


            <tr id="sks1" style="display: <?php if($data['id_kategori_pembayaran']!="2"){echo "none";}?>;">
                <td width="30%"><strong> Jumlah Bayar SKS Teori</strong>
                </td>
                <td>

                <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                       <input type="text" name="jum_sks_teori" class="form-control" id="jum_sks_teori" value="<?php echo $data['jum_sks_teori'];?>" placeholder="Masukkan Jumlah Bayar Contoh : 50000">
                        <div class="input-group-addon">
                        ,00
                        </div>
                        </div>
                        </div>


                </td>
            </tr>
            <tr id="sks2" style="display: <?php if($data['id_kategori_pembayaran']!="2"){echo "none";}?>;">
                <td width="30%"><strong> Jumlah Bayar SKS Praktek</strong>
                </td>
                <td>

                        <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                       <input type="text" name="jum_sks_praktek" class="form-control" id="jum_sks_praktek" value="<?php echo $data['jum_sks_praktek'];?>" placeholder="Masukkan Jumlah Bayar Contoh : 50000">
                        <div class="input-group-addon">
                        ,00
                        </div>
                        </div>
                        </div>


                </td>
            </tr>


            
          
       
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">
                  <?php echo '
                      <a class="btn btn-primary btn-lg" href="'.base_url().$controller.'/editsetting/'.$data['id_setting_tagihan'].'"><i class="fa fa-sign-in"></i> Simpan</a> ';?>
                        

                        
                        <a href="<?php echo base_url().$controller;?>/settingtagihan" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
                        </div>

                        </form>
                   
</div>
</div>
</div>
<div class="col-md-2 col-xs-0">
</div>
</div>

    <script>        
    jQuery('#tgl_generate').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
    });
    </script>
            
    <script>


  jQuery(function () {


    jQuery('#id_kategori_pembayaran').on('change', function() {
      var id_kategori=$('#id_kategori_pembayaran').val();
     if(id_kategori=="2"){
      document.getElementById('nonsks').style.display = 'none';
      document.getElementById('sks1').style.display = '';
      document.getElementById('sks2').style.display = '';
    }else{
      document.getElementById('nonsks').style.display = '';
      document.getElementById('sks1').style.display = 'none';
      document.getElementById('sks2').style.display = 'none';
    }
  //document.getElementById('tes2').style.display = 'none';
 // document.getElementById("tes2").style.display="none";
  });
  });


    </script>