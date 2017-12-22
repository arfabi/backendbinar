 

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
  



   <div class="row">             
        
                <div class="col-md-12">
                
                <div class="box box-danger">
                
                <div class="box-header">
                <h3 class="box-title">Rekapitulasi Dana Masuk</h3>
                
                <div class="box-tools">
                  
              <div class="form-group">
              
              <div class="input-group">
              <button type="button" class="btn btn-default pull-right" id="daterange-btn">
              <span>
              <i class="fa fa-calendar"></i> Filter Berdasarkan Tanggal
              </span>
              <i class="fa fa-caret-down"></i>
              </button>
              </div>
              
              </div>

                </div>

                </div>
                <!-- /.box-header -->
                
                <div class="box-body">
                
                
              


                <div align="center">

                  <div class="form-group">                   
                  <div class="btn-group" data-toggle="buttons">
                  <label class="btn btn-warning active" id="statusY">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="Y" autocomplete="off">Semua Dana</label>
                  <label class="btn btn-primary" id="statusT">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="T" autocomplete="off" > Via Cash
                  </label>
                  
                  <label class="btn btn-primary" id="statusM">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="M" autocomplete="off" > Via Transfer
                  </label>
                  
                  <label class="btn btn-primary" id="statusM">
                  <input type="radio" name="status_konfirm" id="status_konfirm" value="M" autocomplete="off" >Via Beasiswa
                  </label>
                  </div>
                  </div>
                  </div>

                   

                 <div class="chart">
                 <canvas id="barChart" style="height:330px"></canvas>
                 </div>
                

              <div align="right"  style="margin-top: 50px;">
                  
                  <div class="form-group">
                  
                  <div class="input-group">
                  <button type="button" class="btn btn-success pull-right">
                  <span>
                  <i class="fa fa-print"></i> Cetak Laporan
                  </span>
                  </button>
                  </div>
                  
                  </div>
              
              </div>
           
          <table class="table">
          <tr>
          <td><strong>Tanggal</strong></td>
          <td><strong>Cash</strong></td>
          <td><strong>Transfer</strong></td>
          <td><strong>Total</strong></td>
          </tr>


          <tr>
          <td>27 Maret 2017</td>
          <td><div class="currency">170.000,00</div></td>
          <td><div class="currency">680.000,00</div></td>
          <td><div class="currency">570.000,00</div></td>
          </tr>

           <tr>
          <td>28 Maret 2017</td>
          <td><div class="currency">170.000,00</div></td>
          <td><div class="currency">680.000,00</div></td>
          <td><div class="currency">570.000,00</div></td>
          </tr>


          <tr>
          <td>Total</td>
          <td><strong><div class="currency">340.000,00</div></strong></td>
          <td><strong><div class="currency">1.360.000,00</div></strong></td>
          <td><strong><div class="currency">1.140.000,00</div></strong></td>
          </tr>


       
          </table>


                 
                          
                </div>  
                </div>
                </div>
        </div>




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




<script src="<?php echo base_url();?>assets/dist/js/moment.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>


<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url();?>assets/plugins/chartjs/Chart.min.js"></script>

<!-- Page script -->
<script>
  $(function () {
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Hari Ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Minggu Ini': [moment().subtract(6, 'days'), moment()],
            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
            'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

  });
</script>



<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */


    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "Agustus", "September", "Oktober", "November", "Desember"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40, 56, 55, 40, 56, 55]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90, 86, 27, 90, 48, 40]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>