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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-fixedheader/css/fixedHeader.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-rowgroup/css/rowGroup.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/template.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
</head>

<body class="hold-transition">

  <div class="login-page bg-soft-primary py-5">
    <div class="col-xl-8 col-11">
      <div class="row align-items-center justify-content-center h-100">
        <div class="col-12">
          <div class="text-center mb-5">
            <img class="brand-image" style="width: 100px;" src="<?= base_url() ?>assets/img/logo-fsains.png">
            <h2><strong>Fakultas Sains</strong></h2>
            UIN Sultan Maulana Hasanuddin Banten
          </div>
        </div>
        <div class="col-12 mb-3">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link rounded-lg active" href="#schedule" data-toggle="tab">Jadwal Sidang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded-lg" href="#login" data-toggle="tab">Login</a>
            </li>
          </ul>
        </div>
        <div class="col-12">
          <div class="tab-content p-0">
            <div class="tab-pane active" id="schedule">
              <div class="card shadow-lg rounded-lg">
                <div class="card-body bg-light rounded-0 rounded-top-lg">
                  <h6 class="mb-2"><i class="bx bx-filter-alt"></i> Filter</h6>
                  <form id="formFilter">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <input type="text" class="form-control rounded" name="nim_filter" placeholder="NIM">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" class="form-control rounded" name="name_filter" placeholder="Nama">
                      </div>
                      <div class="form-group col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="bx bx-calendar"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right periode-filter bg-white" id="periodeFilter" name="periode_filter" placeholder="Tanggal Jadwal" readonly>
                        </div>
                      </div>
                      <div class="col-12 col-md-4">
                        <button type="button" class="btn btn-secondary rounded filter-data"><i class="bx bx-check"></i> Terapkan</button>
                        <button type="button" class="btn btn-outline-primary bg-soft-primary rounded reset-filter-data" data-filter-form="#formFilter" periode-form="#periodeFilter"><i class="bx bx-revision"></i> Reset</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body px-0">
                  <table id="tblShedule" class="table text-dark dt-responsive table-sm" style="width: 100%;">
                    <thead class="bg-soft-primary">
                      <tr>
                          <th></th>
                          <th>NIM</th>
                          <th>Nama</th>
                          <th>Program Studi</th>
                          <th>Tanggal Sidang</th>
                          <th>Ketua Penguji</th>
                          <th>Penguji Utama</th>
                          <th>Penguji Pendamping</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="login">
              <div class="card-group rounded-lg shadow-lg">
                <div class="card p-2 bg-primary rounded-left-lg d-md-block d-none shadow-none">
                  <div class="row justify-content-center">
                    <img style="width: 80%" src="<?= base_url() ?>assets/img/login-illustration.svg">
                  </div>
                </div>
                <div class="card p-4 rounded-right-lg shadow-none">
                  <div class="card-body">
                    <h3 class="text-primary"><b>Selamat Datang 🚀</b></h3>
                    <p class="text-gray">Kampus digital, sidang praktis! Login untuk akses jadwal sidang.</p>
    
                    <hr>
    
                    <form id="formLogin" autocomplete="off">
                      <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-lg rounded-lg bg-light" placeholder="Username" id="username" autofocus>
                      </div>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="password" name="pass" class="form-control form-control-lg rounded-left-lg bg-light" placeholder="Password" id="pass">
                          <div class="input-group-append">
                            <span class="input-group-text rounded-right-lg" data-toggle="password">
                              <i class="fas fa-eye"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <button type="submit" class="btn btn-secondary btn-lg btn-block rounded-lg">Login</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
  <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/loadingOverlay/dist/loadingoverlay.min.js"></script>
  <script src="<?= base_url() ?>assets/js/template.min.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/helper.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/app.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/datatable.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/request.js"></script>

  <?php $this->load->view('_part/script/login_js'); ?>