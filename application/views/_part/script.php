<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Tempusdominus Bootstrap 4 -->
<?php if (
    $this->router->fetch_class() === 'schedule' ||
    $this->router->fetch_class() === 'report'
) { ?>
    <script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<?php } ?>

<!-- Daterangepicker -->
<?php if (
    $this->router->fetch_class() === 'schedule' ||
    $this->router->fetch_class() === 'report'
) { ?>
    <script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<?php } ?>

<!-- Date Picker -->
<?php if (
    $this->router->fetch_class() === 'schedule'
) { ?>
    <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
<?php } ?>

<!-- Jquery Mousewheel -->
<?php if ($this->router->fetch_class() === 'dashboard') { ?>
    <script src="<?= base_url() ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<?php } ?>

<!-- Raphael -->
<?php if ($this->router->fetch_class() === 'dashboard') { ?>
    <script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<?php } ?>

<!-- Jquery Mapael -->
<?php if ($this->router->fetch_class() === 'dashboard') { ?>
    <script src="<?= base_url() ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<?php } ?>

<!-- West Jakarta Map -->
<?php if ($this->router->fetch_class() === 'dashboard') { ?>
    <script src="<?= base_url() ?>assets/js/custom/westJakartaMap.js"></script>
<?php } ?>

<!-- Number -->
<!-- <script src="<?= base_url() ?>assets/plugins/jquery-number-master/jquery.number.js"></script>
<script src="<?= base_url() ?>assets/js/custom/nunber.js"></script> -->

<!-- DataTables & Plugins -->
<?php if (
    $this->router->fetch_class() !== "dashboard"
) { ?>
    <script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/js/fixedColumns.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-fixedheader/js/fixedHeader.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-rowgroup/js/dataTables.rowGroup.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-rowreorder/js/dataTables.rowReorder.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/datatables-rowreorder/js/rowReorder.bootstrap4.min.js"></script>
<?php } ?>

<!-- Custom Input -->
<?php if (
    $this->router->fetch_class() === 'submission'
) { ?>
    <script src="<?= base_url() ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>bsCustomFileInput.init();</script>
<?php } ?>

<!-- Sticky Header -->
<?php if (
    $this->router->fetch_class() === 'classroom' ||
    $this->router->fetch_class() === 'colleger' ||
    $this->router->fetch_class() === 'lecturer' ||
    $this->router->fetch_class() === 'study_program' ||
    $this->router->fetch_class() === 'submission' ||
    $this->router->fetch_class() === 'schedule'
) { ?>
    <script src="<?= base_url() ?>assets/js/custom/stickyHeader.js"></script>
<?php } ?>