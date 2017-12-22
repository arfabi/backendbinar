<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo $title;?> | <?php echo site_title();?></title>

  <link rel="shortcut icon" href="<?php echo asset_url();?>favicon.ico" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo asset_url();?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo asset_url();?>font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo asset_url();?>ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo asset_url();?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo asset_url();?>dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo asset_url();?>plugins/iCheck/square/blue.css">



<!-- jQuery 2.2.3 -->
<script src="<?php echo asset_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-yellow-light fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
   
  <?php include "theme/header.php";?>
      
  </header>
  
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">      
<div class="login-box">
  <div class="login-logo">
    <img src="assets/logotoga.png" width="75" height="75" />
      <span class="logo-lg" style="color:#DD4B39"><b>Anter</b>.In<span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   

    <form id="loginf" name="loginf" method="post" action="<?php echo $form_action;?>">
  
    <h4 align="center">
 <i class="fa fa-lock"></i> Silahkan Login ...</h4><br/>
  <div id="loading" style="text-align: center"> 
  
  </div>



          <div class="form-group has-feedback">   
          <label>Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username Anda">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">   
          <label>Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password Anda">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>


      <div class="row">
        <div class="col-xs-8">
         
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="signin" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Sign In</button>
        </div>
      </div>
    </form> 
  </div>
</div>
    


  
      </section>
    </div>
  </div>
  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    <strong>Copyright &copy; 2016-2017 <a href="http://arfabi.com">ARFABI.COM</a></strong> All Right Reserved.
    </div>
    <strong><i class="fa fa-opencart"></i> Anter.in</strong> - Aplikasi Layanan microservice Delivery order.
  </footer>

  <!-- Control Sidebar -->
 
 <?php //include "theme/controlsidebar.php";?>


  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->







<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/bootstrap/js/jquery.form.js"></script>


  <script>
    
 jQuery(document).ready(function() { 
     jQuery('#btns').addClass('disabled');    
      //elements
      var progressbox     = $('#progressbox');
      var progressbar     = $('#progressbar');
      var statustxt       = $('#statustxt');
      var submitbutton    = $("#signin");
      var myform          = $("#loginf");
      var output          = $("#loading");
      var completed       = '0%';
         jQuery(myform).ajaxForm({
            beforeSend: function() { //brfore sending form
              submitbutton.attr('disabled', ''); // disable upload button
              statustxt.empty();
              progressbox.slideDown(); //show progressbar             
              output.html("<div class='alert alert-info'>Mengecek. . .</div>"); //update element with received data
              progressbar.width(completed); //initial value 0% of progressbar
              statustxt.html(completed); //set status text
              statustxt.css('color','#000'); //initial color of status text
            },
            uploadProgress: function(event, position, total, percentComplete) { //on progress
              progressbar.width(percentComplete + '%') //update progressbar percent complete
              statustxt.html(percentComplete + '%'); //update status text
              output.html("<div class='alert alert-info'>Mengecek. . .</div>"); //update element with received data
              if(percentComplete>50)
                {
                  statustxt.css('color','#fff'); //change status text to white after 50%
                }
              },
            complete: function(response) { // on complete
              output.html(response.responseText); //update element with received data
              //myform.resetForm();  // reset form
              submitbutton.removeAttr('disabled');
               jQuery('#btns').removeClass('disabled');            //enable submit button
              progressbox.slideUp(); // hide progressbar
            }
        });
      });
     

    </script>
    


<!-- jQuery UI 1.11.4 -->
<script src="<?php echo asset_url();?>dist/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 3.3.6 -->
<script src="<?php echo asset_url();?>bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo asset_url();?>dist/js/app.min.js"></script>


</body>
</html>
