<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Content Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-center mb-2">
      <div class="col-12">
        <h1 class="m-0 font-weight-bold"><?= $title ?></h1>
      </div>
    </div>
  </div>
</div>

<!-- Content Body -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card shadow-none rounded-lg border pt-2">
          <div class="sticky-top">
            <div class="card-header bg-white" hidden>
              <h3 class="card-title font-weight-bold"><?= $title ?></h3>
            </div>
            <div class="card-body bg-white">
              <?php if ($this->app->user()->role === "2") { ?>
                <button type="button" class="btn btn-secondary rounded btn-add" <?= $submission_exist->num_rows() === 0 ? '' : 'disabled' ?>><i class="bx bx-plus"></i> Buat</button>
              <?php } ?>
              <button type="button" class="btn btn-outline-primary rounded btn-filter"><i class="bx bx-filter-alt"></i> Filter</button>
            </div>
            <div class="card-body bg-light" style="display: none;">
              <h6 class="mb-2"><i class="bx bx-filter-alt"></i> Filter</h6>
              <form id="formFilter">
                <div class="row">
                  <?php if ($this->app->user()->role === "1") { ?>
                    <div class="form-group col-md-4">
                      <select name="colleger_filter" class="form-control rounded select select-filter">
                        <option value="">Semua Mahasiswa</option>
                        <?php foreach ($collegers->result() as $colleger) { ?>
                          <option value="<?= $colleger->id ?>"><?= "$colleger->nim - $colleger->name" ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  <?php } ?>
                  <div class="form-group col-md-3">
                    <select name="status_filter" class="form-control rounded select select-filter">
                      <option value="">Semua Status</option>
                      <option value="0">Pengajuan</option>
                      <option value="1">Disetujui</option>
                      <option value="2">Direvisi</option>
                      <option value="3">Ditolak</option>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-secondary rounded filter-data"><i class="bx bx-check"></i> Terapkan</button>
                    <button type="button" class="btn btn-outline-primary bg-soft-primary rounded reset-filter-data" data-filter-form="#formFilter"><i class="bx bx-revision"></i> Reset</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="card-body px-0 border-top">
            <table id="tblData" class="table text-dark dt-responsive table-sm" style="width: 100%;">
              <thead class="bg-soft-primary">
                <tr>
                    <th></th>
                    <th>Status</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Program Studi</th>
                    <th>Pembimbing Utama</th>
                    <th>Pembimbing Pendamping</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Status</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Judul</th>
                    <th>Program Studi</th>
                    <th>Pembimbing Utama</th>
                    <th>Pembimbing Pendamping</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th></th>
                </tr>
              </tfoot>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <?php $this->load->view('_part/modal/delete_modal'); ?>
</section>