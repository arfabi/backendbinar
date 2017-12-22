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
<h3 class="box-title">Tambah Konfirmasi Pembayaran</h3>
</div>
<div class="box-body">
    
<form id="form_submit" name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">



              <table class="table">

                    <tr>
                    <td width="30%"><strong>Nama Mahasiswa</strong></td>
                    <td><?php echo $datamahasiswa['nama_lengkap'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>NIM</strong></td>
                    <td><?php echo $datamahasiswa['nim'];?></td>
                    </tr>

                    <tr>
                    <td width="30%"><strong>Program Studi</strong></td>
                    <td><?php echo $datamahasiswa['nama_prodi'];?> (<?php echo $datamahasiswa['nama_jenjang'];?>)</td>
                    </tr>
                
                    <tr>
                    <td><strong>Tanggal Tagihan</strong></td>
                    <td>  <div class="form-group">  
                    <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-calendar-check-o"></i>
                    </div>
                    <input type="text" name="tanggal_tagihan" class="form-control" id="tanggal_tagihan" value="<?php if(!empty($data['tanggal_tagihan'])){ echo ubahtanggal($data['tanggal_tagihan']);}?>" placeholder="Masukkan Tanggal Cth. 15/02/2017">
                    </div>
                    </div></td>
                    </tr>

                    <tr>
                    <td><strong>Kategori Pembayaran</strong></td>
                    <td><div class="form-group">  
                    <div class="input-group">
                    <div class="input-group-addon">
                    <i class="fa fa-bank"></i>
                    </div>
                    <select name="id_kategori_pembayaran" id="id_kategori_pembayaran" class="form-control">
                    
                    <?php foreach($kategori as $databank){?>
                    <option value ="<?php echo $databank['id_kategori_pembayaran'];?>"><?php echo $databank['nama_kategori_pembayaran'];?></option>
                    <?php } ?>
                    </select>
                    
                    </div>
                    </div></td>
                    </tr>




                 
                    <tr>
                    <td><strong>Total Tagihan</strong></td>
                    <td><div class="form-group">  
                    <div class="input-group">
                    <div class="input-group-addon">
                    Rp.
                    </div>
                    <input type="number" value="<?php echo $data['total_pembayaran'];?>"  name="total_pembayaran" class="form-control" id="total_pembayaran" placeholder="Masukkan Nominal Jumlah Bayar Contoh 150000">
                    </div>
                    <span class="small"><em>Tanpa Menggunakan titik</em></span>
                    </div></td>
                    </tr>
            

            <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="<?php echo $id;?>" >
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">

                        <button type="submit" id="simpandata" name="simpandata" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Simpan</button>
                        
                        <a href="<?php echo base_url().$controller;?>/detailtagihanmhs/<?php echo $id;?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
                        </div>

                        </form>
                   
</div>
</div>
</div>
<div class="col-md-2 col-xs-0">
</div>
</div>

    <script>        
    jQuery('#tanggal_tagihan').datepicker({
    autoclose: true,
    format: 'dd/mm/yyyy'
    });
    </script>
            
    <script>


  jQuery(function () {
  jQuery("input[name='status_konfirm']").change(function(){
  var status=$('input[name=status_konfirm]:checked').val();

   if(status=="Y"){
   document.getElementById("statusY").setAttribute("class", "btn btn-success active");
   document.getElementById("statusT").setAttribute("class", "btn btn-danger");   
   document.getElementById("statusM").setAttribute("class", "btn btn-danger");   
   }else if(status=="M"){
   document.getElementById("statusM").setAttribute("class", "btn btn-success active");
   document.getElementById("statusT").setAttribute("class", "btn btn-danger");     
   document.getElementById("statusY").setAttribute("class", "btn btn-danger"); 
   }else{
   document.getElementById("statusT").setAttribute("class", "btn btn-success active");
   document.getElementById("statusY").setAttribute("class", "btn btn-danger");  
   document.getElementById("statusM").setAttribute("class", "btn btn-danger"); 
   }
 
  });
  });


    </script>