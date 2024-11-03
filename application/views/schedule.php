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
              <button type="button" class="btn btn-secondary rounded btn-add"><i class="bx bx-plus"></i> Tambah</button>
              <button type="button" class="btn btn-outline-primary rounded btn-filter"><i class="bx bx-filter-alt"></i> Filter</button>
            </div>
            <div class="card-body bg-light" style="display: none;">
              <h6 class="mb-2"><i class="bx bx-filter-alt"></i> Filter</h6>
              <form id="formFilter">
                <div class="row">
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control rounded" name="number_filter" placeholder="Nomor Surat">
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
                  <div class="form-group col-md-4">
                    <select name="submission_filter" class="form-control rounded select select-filter">
                        <option value="">Semua Pengajuan Sidang</option>
                        <?php foreach ($submissions->result() as $submission) { ?>
                            <option value="<?= $submission->id ?>"><?= "$submission->nim-$submission->name" ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="col-12 col-md-4">
                    <button type="button" class="btn btn-secondary rounded filter-data"><i class="bx bx-check"></i> Terapkan</button>
                    <button type="button" class="btn btn-outline-primary bg-soft-primary rounded reset-filter-data" data-filter-form="#formFilter" periode-form="#periodeFilter"><i class="bx bx-revision"></i> Reset</button>
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
                    <th>Nomor Surat</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Tanggal Sidang</th>
                    <th>Ketua Penguji</th>
                    <th>Penguji Utama</th>
                    <th>Penguji Pendamping</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Nomor Surat</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Tanggal Sidang</th>
                    <th>Ketua Penguji</th>
                    <th>Penguji Utama</th>
                    <th>Penguji Pendamping</th>
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

  <div class="modal fade" id="mdlFormData">
    <div class="modal-dialog">
      <div class="modal-content rounded-lg shadow-lg border-none">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
        </div>
        <form id="formData" autocomplete="false">
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label>Nomor Surat</label>
                  <input type="text" class="form-control rounded bg-light" name="number" maxlength="100" id="number">
                </div>
                <div class="form-group">
                  <label>Tanggal</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text rounded-0 rounded-left">
                        <i class="bx bx-calendar"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control rounded-0 rounded-right bg-light date" name="date" id="date" readonly>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Jam Mulai</label>
                          <div class="input-group" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#startTime">
                              <div class="input-group-text rounded-0 rounded-left">
                                <i class="bx bx-time"></i>
                              </div>
                            </div>
                            <input type="text" name="start_time" id="startTime" class="form-control datetimepicker-input rounded-0 rounded-right bg-light" data-toggle="datetimepicker" data-target="#startTime" readonly />
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                          <label>Jam Selesai</label>
                          <div class="input-group" data-target-input="nearest">
                            <div class="input-group-prepend" data-target="#endTime">
                              <div class="input-group-text rounded-0 rounded-left">
                                <i class="bx bx-time"></i>
                              </div>
                            </div>
                            <input type="text" name="end_time" id="endTime" class="form-control datetimepicker-input rounded-0 rounded-right bg-light" data-toggle="datetimepicker" data-target="#endTime" readonly />
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pengajuan Sidang Mahasiswa</label>
                    <select name="submission" class="form-control rounded select bg-light" style="width: 100%;">
                        <option value="">Pilih Pengajuan Sidang</option>
                        <?php foreach ($submissions->result() as $submission) { ?>
                            <option value="<?= $submission->id ?>"><?= "$submission->nim-$submission->name" ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ketua Penguji</label>
                    <select name="lead_tester" id="leadTester" class="form-control rounded bg-light select">
                        <option value="">Pilih Ketua Penguji</option>
                        <?php foreach ($lectures->result() as $lecturer) { ?>
                            <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Penguji Utama</label>
                    <select name="main_tester" id="mainTester" class="form-control rounded bg-light select">
                        <option value="">Pilih Penguji Utama</option>
                        <?php foreach ($lectures->result() as $lecturer) { ?>
                            <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Penguji Pendamping</label>
                    <select name="secondary_tester" id="secondaryTester" class="form-control rounded bg-light select">
                        <option value="">Pilih Penguji Pendamping</option>
                        <?php foreach ($lectures->result() as $lecturer) { ?>
                            <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                        <?php } ?>
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer rounded-lg rounded-top-0 bg-light justify-content-right">
            <a href="javascript:void(0)" class="mr-2 font-weight-bold" data-dismiss="modal">Batal</a>
            <button type="submit" class="btn btn-secondary rounded btn-submit"></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <?php $this->load->view('_part/modal/delete_modal'); ?>
</section>