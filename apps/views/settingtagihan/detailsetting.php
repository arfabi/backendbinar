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
<h3 class="box-title">Detail Setting Tagihan</h3>
</div>
<div class="box-body">

<form id="form_submit" name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">



 <table class="table">

        




            <tr>
                <td width="30%"><strong>Tanggal Tagihan</strong>
                </td>
                <td>
                    <?php echo ubahtanggal2($data['tgl_generate']);?>
                </td>
            </tr>

            <tr>
                <td width="30%"><strong> Program Studi</strong>
                </td>
                <td>
                 <?php echo $data['nama_prodi'];?> (<?php echo $data['nama_jenjang'];?>)                  
                </td>
            </tr>

             <tr>
                <td width="30%"><strong> Tahun Angkatan</strong>
                </td>
                <td>
                   <?php echo $data['tahun_angkatan'];?> 
                </td>
            </tr>

            <tr>
                <td width="30%"><strong> Kategori Pembayaran</strong>
                </td>
                <td>
                   <?php echo $data['nama_kategori_pembayaran'];?> 
                </td>
            </tr>

               <tr>
                <td width="30%"><strong> Semester</strong>
                </td>
               <td>
                  <?php echo $data['nama_jenis_semester'].' '.$data['tahun_akademik'];?>
                
                </td>
            </tr>
            

            <?php if(empty($data['jum_sks_teori'])){?>
      
            <tr>
                <td width="30%"><strong> Jumlah Bayar</strong>
                </td>
                <td><?php echo 'Rp. '.number_format($data['jumlah_bayar'],2,',','.').'';?>  (<?php echo terbilang($data['jumlah_bayar']);?> Rupiah )

                </td>
            </tr>
            <?php }else{?>
            <tr>
                <td width="30%"><strong> Jumlah Bayar SKS Teori</strong>
                </td>
                <td><?php echo 'Rp. '.number_format($data['jum_sks_teori'],2,',','.').'';?> / SKS
                (<?php echo terbilang($data['jum_sks_teori']);?> Rupiah )

                </td>
            </tr>
            <tr>
                <td width="30%"><strong> Jumlah Bayar SKS Praktek</strong>
                </td>
                <td><?php echo 'Rp. '.number_format($data['jum_sks_praktek'],2,',','.').'';?> / SKS (<?php echo terbilang($data['jum_sks_praktek']);?> Rupiah )

                </td>
            </tr>
            <?php } ?>


            


          
              <tr>
                <td><strong>Status</strong></td>
                <td>

                <?php                
                if($data['status_generate']=="Y"){ echo "<span class='label label-success'>Sudah Generate</span>";}
                else if($data['status_generate']=="T"){ echo "<span class='label label-danger'>Gagal Generate</span>";}
                else if($data['status_generate']=="B"){ echo "<span class='label label-warning'>Belum Generate</span>";}        
                ?>

                </td>
            </tr>
           
       
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">
                  <?php echo '
                      <a class="btn btn-primary btn-md" href="'.base_url().$controller.'/editsetting/'.$data['id_setting_tagihan'].'"><i class="fa fa-edit"></i> Edit Setting</a> ';?>
                        
                        <?php echo '
                      <a class="btn btn-danger btn-md" data-toggle="modal" data-target="#confirm-hapus" data-href="'.base_url().$controller.'/deletesetting/'.$data['id_setting_tagihan'].'"><i class="fa fa-trash"></i> Hapus Setting</a> ';?>

                        
                        <a href="<?php echo base_url().$controller;?>/" class="btn btn-warning btn-md"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
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