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
<h3 class="box-title">Form Pembayaran via Cash</h3>
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
                <td width="30%"><strong> Nama Penyetor</strong>
                </td>
                <td>
                    
                       <?php echo $data['nama_pengirim'];?>
                </td>
            </tr>
            <tr>
                <td><strong>Tanggal Bayar</strong></td>
                <td>  <?php echo ubahtanggal($data['tgl_transfer']);?></td>
            </tr>
            <tr>
                <td><strong>Bank</strong></td>
                <td> <?php echo $data['nama_bank'];?></td>
            </tr>
            <tr>
                <td><strong>Jumlah Bayar</strong></td>
                <td>Rp. 
                <?php echo number_format($data['jumlah_bayar'],2,',','.');?>
                (<?php echo terbilang($data['jumlah_bayar']);?> Rupiah)
            </tr>
          
       
           
                
            </table>

                <br/>
                  <div id="loading" style="text-align: center"></div>
                      
                  <div align="center">

                        <a href="<?php echo base_url().$controller;?>/cetakkwitansi/<?php echo $data['id_transaksi'];?>" class="btn btn-success btn-lg"><i class="glyphicon glyphicon-print"></i> Cetak Bukti</a>


                        <a href="<?php echo base_url().$controller;?>" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>

                      
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