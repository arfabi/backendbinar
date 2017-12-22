    
      
  <link rel="stylesheet" href="<?php echo asset_url();?>plugins/datatables/dataTables.bootstrap.css">
        
        <!--
          <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
            <i class="fa fa-spin fa-refresh"></i>&nbsp; Get External Content
          </button>

          -->

 
         <a class="btn btn-primary btn-lg" id="tambahproduk" href="<?php echo base_url().$controller;?>/add"><i class="fa fa-plus-circle"></i> Produk Baru </a>
     

        <br/><br/>

        <div class="row">             
        
                <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Data Produk</h3>
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Kategori</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Harga Beli</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th width="10%">Aksi</th>
                </tr>
                </thead>
                <tbody>
               
                </tbody>

                <tfoot>
                
                </tfoot>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


                </div>
        </div>


<!-- DataTables -->
<script src="<?php echo asset_url();?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo asset_url();?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      ordering: true,
      processing: true,
      serverSide: true,
      "pageLength": 25,
      ajax: {
      url: "<?php echo base_url().$controller; ?>/getproducts",
      type:'POST',
      },

      "language": {
      "search": "Cari Barang :"
      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "language": {
      "search": "Cari Barang :"
      },
      "autoWidth": false
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



