<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Content Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-center mb-2">
      <div class="col-md-10">
        <h1 class="m-0 font-weight-bold"><?= $title ?></h1>
      </div>
    </div>
  </div>
</div>

<!-- Content Body -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card shadow-none border rounded-lg pt-2">
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
                  <div class="form-group col-6 col-md-2">
                    <select name="role_filter" class="form-control rounded select select-filter">
                      <option value="">Semua Role</option>
                      <option value="1">Admin</option>
                      <option value="2">Mahasiswa</option>
                    </select>
                  </div>
                  <div class="form-group col-6 col-md-4">
                    <input type="text" class="form-control rounded" name="name_filter" placeholder="Nama / Username Pengguna">
                  </div>
                  <div class="col-12 col-md-4">
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
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Dibuat</th>
                  <th>Diubah</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th></th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Role</th>
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
      <div class="modal-content rounded-lg shadow-lg">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
        </div>
        <form id="formData" autocomplete="false">
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control rounded bg-light" name="name" maxlength="200" id="name">
                </div>
                <div class="form-group">
                  <label>Role</label>
                  <select name="role" id="role" class="form-control rounded bg-light select">
                    <option value="1">Admin</option>
                    <option value="2">Mahasiswa</option>
                  </select>
                </div>
                <div class="form-group" style="display: none;">
                  <label>Mahasiswa</label>
                  <select name="colleger" id="colleger" class="form-control rounded bg-light select">
                    <option value="">Pilih Mahasiswa</option>
                    <?php foreach ($collegers->result() as $colleger) { ?>
                      <option value="<?= $colleger->id ?>"><?= "$colleger->nim - $colleger->name" ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body border-top">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control rounded bg-light" name="username" maxlength="100" id="username">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control rounded bg-light" name="pass" maxlength="100" id="pass">
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