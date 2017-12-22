       
        <br/><br/>


  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/select2.min.css">

        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-warning">
                
                <div class="box-header">
                <h3 class="box-title">Form Tambah Produk</h3>
                
              
                </div>
                <!-- /.box-header -->
                
                <div class="box-body">
               
               <form id="form_submit"  name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">

                   <!-- /.form group -->
                        <div class="form-group">            
                        <label>Kategori Produk</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-folder-open"></i>
                        </div>
                        <select name="id_kategori" id="id_kategori" class="form-control select2">
                          <option value="">Pilih Kategori</option>
                          <?php foreach($datakategori as $dt){?>
                          <option value="<?php echo $dt['id_kategori'];?>"><?php echo $dt['nama_kategori'];?></option>
                          <?php } ?>
                        </select>
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      
                      <div class="row">
                        <div class="col-md-6">
                        <!-- /.form group -->
                        <div class="form-group">            
                        <label>Kode Produk</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-bars"></i>
                        </div>
                        <input type="text" name="kd_barang" id="kd_barang" class="form-control" value="">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group">            
                        <label>Nama Produk</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-shopping-cart"></i>
                        </div>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-md-6">
                        <!-- /.form group -->
                        <div class="form-group">            
                        <label>Harga Beli (HPP) Produk</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                        <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        </div>
                        
                        <div class="col-md-6">
                        <div class="form-group">            
                        <label>Harga Jual Produk</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        Rp.
                        </div>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        </div>
                      </div>

                       <div class="form-group">            
                        <label>Stok Awal</label>
                        <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-database"></i>
                        </div>
                        <input type="number" name="stok_awal" id="stok_awal" class="form-control" value="">
                        </div>
                        <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      
                        

                        <br/>
                        <div id="loading" style="text-align: center"></div>
                        <div align="center">
                        <button name="simpandata" id="simpandata" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Simpan</button>
                        <a href="<?php echo base_url().$controller;?>" name="batal" id="batal" class="btn btn-warning btn-lg"><i class="fa fa-arrow-circle-left"></i> Kembali</a>             
                        </div>
                        
                </form>                 


                </div>  
                </div>
                
                </div>
                
                
                
        
        </div>
        
          <script type="text/javascript">
            
  jQuery(function () {

  jQuery("input[name='status']").change(function(){
  var status=$('input[name=status]:checked').val();

   if(status=="A"){
   document.getElementById("KetAktif").setAttribute("class", "btn btn-success active");
   document.getElementById("KetTidak").setAttribute("class", "btn btn-danger");
   }else if(status=="T"){
   document.getElementById("KetTidak").setAttribute("class", "btn btn-success active");
   document.getElementById("KetAktif").setAttribute("class", "btn btn-danger");
   }
  });
  });
          </script>



<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>


<script>
  jQuery(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });

    </script>