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
                  <div class="form-group col-md-3">
                    <input type="text" class="form-control rounded" name="nidn_filter" placeholder="NIDN">
                  </div>
                  <div class="form-group col-md-3">
                    <input type="text" class="form-control rounded" name="name_filter" placeholder="Nama Dosen">
                  </div>
                  <div class="form-group col-md-3">
                    <select name="study_filter" class="form-control rounded select select-filter">
                      <option value="">Semua Program Studi</option>
                      <?php foreach ($studies->result() as $study) { ?>
                        <option value="<?= $study->id ?>"><?= $study->name ?></option>
                      <?php } ?>
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
                    <th>NIDN</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Program Studi</th>
                    <th>Jabatan</th>
                    <th>Dibuat</th>
                    <th>Diubah</th>
                    <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th></th>
                    <th>NIDN</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Program Studi</th>
                    <th>Jabatan</th>
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
                  <label>NIDN</label>
                  <input type="text" class="form-control rounded bg-light" name="nidn" maxlength="100" id="nidn">
                </div>
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control rounded bg-light" name="nip" maxlength="100" id="nip">
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control rounded bg-light" name="name" maxlength="100" id="name">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="address" id="address" class="form-control rounded bg-light" maxlength="200" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Program Studi</label>
                    <select name="study_program" id="studyProgram" class="form-control bg-light rounded select" style="width: 100%;">
                        <option value="">Pilih Program Studi</option>
                        <?php foreach ($studies->result() as $study) { ?>
                            <option value="<?= $study->id ?>"><?= $study->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" class="form-control rounded bg-light" name="job_position" maxlength="100" id="jobPosition">
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