<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->config->item('app_name') ?> | <?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <?php $this->load->view('_part/stylesheet'); ?>

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/template.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">

</head>

<!-- Body Section -->

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <?php $this->load->view('_part/navbar'); ?>
        <!-- Sidebar -->
        <?php $this->load->view('_part/sidebar'); ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?= $contents; ?>
        </div>

        <!-- Footer -->
        <?php $this->load->view('_part/footer'); ?>

    </div>

    <!-- Script -->
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar -->
    <script type="text/javascript">
        let segment = <?= json_encode($this->uri->segment('1')) ?>;
        $('ul.nav-sidebar a').filter(function() {
            return $(this).data('segment') === segment;
        }).addClass('active');
    </script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Template App -->
    <script src="<?= base_url() ?>assets/js/template.js"></script>
    <script src="<?= base_url() ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/scrollbar.js"></script>
    <script src="<?= base_url() ?>assets/plugins/loadingOverlay/dist/loadingoverlay.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
    
    <!-- Custom Script -->
    <?php $this->load->view('_part/script/global_js'); ?>
    <?php $this->load->view('_part/script'); ?>
    
    <script src="<?= base_url() ?>assets/js/custom/sidemenu.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/helper.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/app.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/datatable.js"></script>
    <script src="<?= base_url() ?>assets/js/custom/request.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

    <?= $contents_script; ?>

</body>

</html>