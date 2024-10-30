<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="font-weight-bold mb-4 mt-2">👋 Halo, <?= $this->app->user()->name ?></h2>
      </div>
    </div>

    <div class="row border-bottom">
      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
          <span class="info-box-icon"><i class="bx bx-user-pin"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Produk</span>
            <h5><span class="info-box-number">0</span></h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
          <span class="info-box-icon"><i class="bx bx-flag"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Supplier</span>
            <h5><span class="info-box-number">0</span></h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
          <span class="info-box-icon"><i class="bx bx-user-circle"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pelanggan</span>
            <h5><span class="info-box-number">0</span></h5>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-md-6 col-sm-12">
        <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
          <span class="info-box-icon"><i class="bx bx-calendar"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Cabang</span>
            <h5><span class="info-box-number">0</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>