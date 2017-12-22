<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo $title;?> - <?php echo site_title();?></title>

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

  
<!-- jQuery 2.2.3 -->
<script src="<?php echo asset_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-yellow fixed layout-top-nav">
<div class="wrapper">

  <header class="main-header">
   
  <?php include "theme/menuuser.php";?>
      
  </header>
  
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) 
       <section class="content-header">
       
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Beranda</li>
        </ol>
      </section>
    -->

      <!-- Main content -->
      <section class="content">

       <?php if($controller=="dashboard"){?>
         <div class="login-logo">
    <img src="assets/logo.png" width="300" height="85" />
    <!--
      <span class="logo-lg" style="color:#DD4B39"><b>Simak</b>Gama<span>
      -->
         </div>
       <?php } ?>

      <?php if($controller!='dashboard'){?>
      <section class="content-header">       
      <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> Home</a></li>
      <?php if(!empty($action)){ ?> 
      <li><a href="<?php echo base_url();?><?php echo $controller;?>"> <?php echo ucfirst($controller);?> </a> </li>
      <?php } ?>
      <li class="active"><?php echo $title;?></li>
      </ol>
      </section>
      <?php } ?>
     
        <?php if($controller!="dashboard"){?>

        <h2 align="center" style="color:#3C8DBC"><?php echo $title;?></h2>      
        <br/>
        <?php } ?>
      
      <?php include $path_action;?>
      <?php include "theme/formaction.php";?>
      <?php include "theme/modal.php";?>
        <?php if($controller!="dashboard"){ include "shortcut.php"; } ?>
     
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    <strong>Copyright &copy; 2016-2017 <a href="http://arfabi.com">ARFABI.COM</a></strong> All Right Reserved.
    </div>
    <strong><i class="fa fa-opencart"></i> AksaPos</strong> - Aplikasi Kasir & Penjualan Online.
  </footer>

  <!-- Control Sidebar -->
 
 <?php //include "theme/controlsidebar.php";?>


  <!-- /.control-sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo asset_url();?>dist/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo asset_url();?>bootstrap/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo asset_url();?>dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo asset_url();?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo asset_url();?>dist/js/demo.js"></script>
</body>
</html>
