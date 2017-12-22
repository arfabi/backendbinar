
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo asset_url();?>plugins/datatables/dataTables.bootstrap.css">
        
        <a class="btn btn-primary btn-lg ajax" href="<?php echo base_url().$controller;?>/add"><i class="fa fa-plus-circle"></i> Kategori Baru </a>

        <br/><br/>



        <div class="row">             
        
                <div class="col-md-12">
          <div class="box box-warning">
            <div class="box-header">
              <h3 class="box-title">Data Kategori Produk</h3>
            </div>

    
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%">No.</th>
                  <th>Kategori</th>
                  <th width="20%">Status</th>
                  <th align="center" width="20%">Aksi</th>
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
      "search": "Cari Kategori Berdasarkan Nama :"
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

