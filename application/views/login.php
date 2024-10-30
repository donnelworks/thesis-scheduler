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
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/template.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/custom.css">
</head>

<body class="hold-transition">

  <div class="login-page bg-soft-primary">
    <div class="col-xl-8 col-11 ">
      <div class="row align-items-center justify-content-center h-100">
        <div class="col-12">
          <div class="card-group rounded-lg shadow-lg">
            <div class="card p-2 bg-primary rounded-left-lg d-md-block d-none shadow-none">
              <img class="brand-image m-2" style="width: 25%" src="<?= base_url() ?>assets/img/logo/siska-logo-full-white.svg">
              <div class="row justify-content-center">
                <img style="width: 80%" src="<?= base_url() ?>assets/img/login-illustration.svg">
              </div>
            </div>
            <div class="card p-4 rounded-right-lg shadow-none">
              <div class="card-body">
                <div class="text-center d-sm-block d-md-none">
                  <img class="brand-image mb-5" style="width: 60%" src="<?= base_url() ?>assets/img/logo/siska-logo-full-color.svg">
                </div>
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

  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url() ?>assets/plugins/loadingOverlay/dist/loadingoverlay.min.js"></script>
  <script src="<?= base_url() ?>assets/js/template.min.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/helper.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/app.js"></script>
  <script src="<?= base_url() ?>assets/js/custom/request.js"></script>

  <?php $this->load->view('_part/script/login_js'); ?>