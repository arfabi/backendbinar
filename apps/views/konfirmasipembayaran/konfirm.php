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
<h3 class="box-title">Konfirmasi Pembayaran</h3>
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
                   <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control">
                   <option value ="Langsung" <?php if($data['jenis_pembayaran']=="Langsung"){ echo "Selected";}?>>Bayar Langsung</option>
                   <option value ="Beasiswa" <?php if($data['jenis_pembayaran']=="Beasiswa"){ echo "Selected"; }?>>Beasiswa</option>
                   <option value ="Bank" <?php if($data['jenis_pembayaran']=="Transfer"){ echo "Selected"; }?>>Transfer Bank</option>
                   </select>                  
                </td>
            </tr>


            <tr>
                <td width="30%"><strong> Atas Nama Pengirim / Penyetor</strong>
                </td>
                <td>
                    
                        <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-users"></i>
                        </div>
                       <input type="text" name="nama_pengirim" class="form-control" id="nama_pengirim" value="<?php echo $data['nama_pengirim'];?>" placeholder="Masukkan Nama Pengirim / Atas Nama Rekening Pengirim">
                        </div>
                        </div>

                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Setor</strong></td>
                <td>  <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-check-o"></i>
                        </div>
                       <input type="text" name="tgl_transfer" class="form-control" id="tgl_transfer" value="<?php if(!empty($data['tgl_transfer'])){ echo ubahtanggal($data['tgl_transfer']);}?>" placeholder="Masukkan Tanggal Cth. 15/02/2017">
                        </div>
                        </div></td>
            </tr>
            <tr>
                <td><strong>Bank Pengirim</strong></td>
                <td><div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-bank"></i>
                        </div>
                        <select name="bank_pengirim" id="bank_pengirim" class="form-control">
                        
                        <?php foreach($bank as $databank){?>
                        <option value ="<?php echo $databank['id_bank'];?>" <?php if($data['id_bank_pengirim']==$databank['id_bank']){ echo "Selected";}?>><?php echo $databank['nama_bank'];?></option>
                       <?php } ?>
                        </select>

                        </div>
                        </div></td>
            </tr>
            <tr>
                <td><strong>Jumlah Transfer</strong></td>
                <td><div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                       <input type="number" value="<?php echo $data['jumlah_bayar'];?>"  name="jumlah_bayar" class="form-control" id="jumlah_bayar" placeholder="Masukkan Nominal Jumlah Bayar">
                        </div>
                        </div></td>
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
                    
                    <div class="form-group">  
                        <div class="input-group">
                        <div class="input-group-addon">
                       <i class="fa fa-image"></i>
                        </div>
                       <input type="file" name="gambar_bukti" id="gambar_bukti" class="form-control"  placeholder="Klik untuk Upload File">
                        </div>
                        </div>


                </td>
            </tr>

              <tr>
                <td><strong>Status</strong></td>
                <td>
                    
                  <div class="form-group">                   
                  <div class="btn-group" data-toggle="buttons">
                  <label class="<?php if($data['status_konfirm']=="Y"){ echo "btn btn-success active"; }else { echo "btn btn-danger";}?>" id="statusY">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="Y" autocomplete="off" <?php if($data['status_konfirm']=="Y"){ echo "checked"; }?> ><i class="fa fa-check-circle-o"></i> Sudah Konfirmasi
                  </label>
                  <label class="<?php if($data['status_konfirm']=="T"){ echo "btn btn-success active"; }else { echo "btn btn-danger";}?>" id="statusT">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="T" autocomplete="off"  <?php if($data['status_konfirm']=="T"){ echo "checked"; }?>><i class="fa fa-times-circle"></i> Batal Konfirmasi
                  </label>

                  <label class="<?php if($data['status_konfirm']=="M"){ echo "btn btn-success active"; }else { echo "btn btn-danger";}?>" id="statusM">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="M" autocomplete="off"  <?php if($data['status_konfirm']=="M"){ echo "checked"; }?>><i class="fa fa-spinner"></i> Menunggu Konfirmasi
                  </label>


                  </div>
                  <!-- /.input group -->
                  </div>
                </td>
            </tr>
           
       
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">

                          <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?php echo $id;?>" >
                          <input type="hidden" name="id_tagihan" id="id_tagihan" value="<?php echo $data['id_tagihan'];?>" >
                          
                        <button type="submit" id="simpandata" name="simpandata" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Simpan</button>
                        
                        <a href="<?php echo base_url().$controller;?>/detailkonfirmasi/<?php echo $id;?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
                        </div>

                        </form>
                   
</div>
</div>
</div>
<div class="col-md-2 col-xs-0">
</div>
</div>

    <script>        
    jQuery('#tgl_transfer').datepicker({
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