<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Content Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-center mb-2">
      <div class="col-md-8">
        <a href="<?= site_url('submission') ?>" class="text-muted">Daftar Pengajuan</a>
        <h1 class="m-0 font-weight-bold"><?= $title ?></h1>
      </div>
    </div>
  </div>
</div>

<!-- Content Body -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-none rounded-lg border">
            <form id="formData" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" readonly>
                <div class="card-body">
                    <div class="form-group">
                        <label>Judul Skripsi/Tugas Akhir</label>
                        <input type="text" name="title" id="title" class="form-control form-control-lg form-control-border bg-light rounded-0" maxlength="100">
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Pembimbing Utama</label>
                            <select name="main_lecturer" id="mainLecturer" class="form-control rounded bg-light select">
                                <option value="">Pilih Pembimbing Utama</option>
                                <?php foreach ($lectures->result() as $lecturer) { ?>
                                    <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pembimbing Pendamping</label>
                            <select name="secondary_lecturer" id="secondaryLecturer" class="form-control rounded bg-light select">
                                <option value="">Pilih Pembimbing Pendamping</option>
                                <?php foreach ($lectures->result() as $lecturer) { ?>
                                    <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. Tlp.</label>
                            <input type="text" name="phone" id="phone" class="form-control bg-light rounded" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div class="form-group">
                        <label>UPLOAD Formulir Pengajuan</label>
                        <div class="custom-file">
                            <input type="file" name="submission_form" class="custom-file-input" id="submissionForm" accept=".pdf">
                            <label class="custom-file-label" id="labelSubmissionForm" for="submissionForm">Cari File</label>
                        </div>
                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                    </div>
                    <div class="form-group">
                        <label>UPLOAD KTM</label>
                        <div class="custom-file">
                            <input type="file" name="ktm" class="custom-file-input" id="ktm" accept=".pdf,.jpg,.jpeg,.png">
                            <label class="custom-file-label" id="labelKTM" for="ktm">Cari File</label>
                        </div>
                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-secondary rounded btn-save"><i class="bx bx-save"></i> Simpan</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <?php $this->load->view('_part/modal/delete_modal'); ?>
</section>