<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Daterange Picker -->
<?php if (
    $this->router->fetch_class() === "schedule" ||
    $this->router->fetch_class() === "report"
) { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
<?php } ?>

<!-- Datepicker -->
<?php if ($this->router->fetch_class() === "schedule") { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<?php } ?>

<!-- Tempusdominus Bootstrap 4 -->
<?php if ($this->router->fetch_class() === "schedule") { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<?php } ?>

<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars-thin-dark.css">

<!-- ICheck -->
<?php if (
    $this->router->fetch_class() === "source" ||
    $this->router->fetch_class() === "member" ||
    $this->router->fetch_class() === "schedule"
) { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<?php } ?>

<!-- DataTables -->
<?php if ($this->router->fetch_class() !== "dashboard") { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
<?php } ?>

<!-- Leafletjs -->
<?php if (
    $this->router->fetch_class() === "dashboard" ||
    $this->router->fetch_class() === "schedule"
) { ?>
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/leaflet/Control.FullScreen.css">
<?php } ?>