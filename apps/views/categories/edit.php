       
        <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-warning">
                
                <div class="box-header">
                <h3 class="box-title">Form Edit Kategori</h3>
                
              
                </div>
                <!-- /.box-header -->
                
                <div class="box-body">
               
               <form id="form_submit"  name="form_submit" enctype="multipart/form-data" method="post" action="<?php echo $form_action;?>">

                 <div class="row">
                         <div class="col-md-6">
                      <!-- /.form group -->
                          <div class="form-group">            
                          <label>Nama Kategori</label>
                          <div class="input-group">
                          <div class="input-group-addon">
                          <i class="fa fa-bars"></i>
                          </div>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="<?php echo $data['nama_kategori'];?>">
                          </div>
                          <!-- /.input group -->
                          </div>
                      <!-- /.form group -->
                      </div>

                         <div class="col-md-6">
                          <div class="form-group">         
                          <label>Status Kategori</label><br/>
                                 
                  <div class="btn-group" data-toggle="buttons">
                  <label class="<?php if($data['status_kategori']=="A"){ echo "btn btn-success active"; }else{
                    echo "btn btn-danger";
                    } ?>" id="KetAktif">
                  <input type="radio" name="status" id="status" value="A" autocomplete="off" <?php if($data['status_kategori']=="A"){ echo "checked"; } ?>><i class="fa fa-check-circle-o"></i> Aktif
                  </label>

                  <label class="<?php if($data['status_kategori']=="T"){ echo "btn btn-success active"; }else{
                    echo "btn btn-danger";
                    } ?> " id="KetTidak">
                  <input type="radio" name="status" id="status" value="T" autocomplete="off" <?php if($data['status_kategori']=="T"){ echo "checked"; } ?>><i class="fa fa-times-circle"></i> Tidak Aktif
                  </label>


                  </div>
                  <!-- /.input group -->
                  </div>
                  </div>
                  </div>
                        

                        
                          <input type="hidden" name="id_kategori" id="id_kategori" value="<?php echo $data['id_kategori'];?>">

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