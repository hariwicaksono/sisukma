<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/startbootstrap-creative/dist/');?>assets/img/favicon.ico" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- BootStrap -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/select2/css/select2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/toastr/toastr.min.css">
  <!-- SweetAlert -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap-sweetalert/dist/sweetalert.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/summernote/summernote-bs4.css">
  <!-- jQuery UI 1.11.4 -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <?php include "view_header.php"?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include "view_sidebar.php"?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?= $contents; ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
     <?php include "view_footer.php"?> 
   </footer>
   <?php include "view_modal.php" ; ?>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery -->
 <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- datepicker -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/moment/moment.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js"></script>
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/')?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/AdminLTE-3.0.5/');?>dist/js/adminlte.js"></script>
 <!-- Summernote -->
 <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/summernote/summernote-bs4.min.js"></script>
<?php include "view_js.php" ; ?>
</body> 
</html>
