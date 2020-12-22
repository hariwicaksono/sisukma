<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title><?= $page ;?> | Fastikom</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/startbootstrap-creative/dist/');?>assets/img/favicon.ico" />
  <!-- Font Awesome icons (free version)-->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/fontawesome-free/css/all.min.css" />
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
  <!-- Third party plugin CSS-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="<?= base_url('assets/startbootstrap-creative/dist/');?>css/styles.css" rel="stylesheet" />
  <!-- SweetAlert -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap-sweetalert/dist/sweetalert.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/toastr/toastr.min.css">
</head>
<body id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <?php include "main_header.php";?>
  </nav>
  <?= $contents; ?>
  <!-- Footer-->
  <footer class="bg-light py-4">
    <?php include "main_footer.php" ; ?>
  </footer>
  <?php include "main_modal.php" ; ?>
  <!-- Bootstrap core JS-->
  <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Third party plugin JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
  <!-- Core theme JS-->
  <script src="<?= base_url('assets/startbootstrap-creative/dist/');?>js/scripts.js"></script>
  <!-- SweetAlert -->
  <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/bootstrap-sweetalert/dist/sweetalert.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url('assets/AdminLTE-3.0.5/');?>plugins/toastr/toastr.min.js"></script>
  <?php include "main_js.php" ; ?>

</body>
</html>
