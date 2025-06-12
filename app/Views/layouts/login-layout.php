<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Login' ?></title>
   <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- dist CSS Files -->
  <link href="<?= base_url('assets/dist/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/dist/simple-datatables/style.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/theme/layout-css/style-admin.css') ?>" rel="stylesheet">

</head>
<body>

<?= $this->renderSection('content') ?>

  <!-- dist JS Files -->
  <script src="<?= base_url('assets/dist/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('assets/dist/echarts/echarts.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/quill/quill.js') ?>"></script>
  <script src="<?= base_url('assets/dist/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/dist/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/dist/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/theme/js/main-admin.js') ?>"></script>

</body>
</html>
