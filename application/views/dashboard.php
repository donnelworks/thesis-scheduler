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

    <?php if ($this->app->user()->role === "1") { ?>
      <div class="row border-bottom">
        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
            <span class="info-box-icon"><i class="bx bxs-school"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Program Studi</span>
              <h5><span class="info-box-number"><?= $study->num_rows() ?></span></h5>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
            <span class="info-box-icon"><i class="bx bx-chalkboard"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Kelas</span>
              <h5><span class="info-box-number"><?= $classroom->num_rows() ?></span></h5>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
            <span class="info-box-icon"><i class="bx bx-briefcase"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Dosen</span>
              <h5><span class="info-box-number"><?= $lecturer->num_rows() ?></span></h5>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 col-sm-12">
          <div class="info-box mb-3 bg-secondary shadow-0 rounded-lg">
            <span class="info-box-icon"><i class="bx bx-id-card"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Mahasiswa</span>
              <h5><span class="info-box-number"><?= $colleger->num_rows() ?></span></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-md-4">
          <div class="card shadow-none border rounded-lg">
            <div class="card-header">
              <h3 class="card-title">Pengajuan Terbaru</h3>
            </div>
            <?php if ($submissions) { ?>
              <div class="card-body">
                <table class="table table-striped">
                  <tbody>
                    <?php foreach ($submissions as $submission) { ?>
                      <tr>
                        <td>
                          <strong><?= "$submission->colleger_name / $submission->colleger_nim" ?></strong> <br>
                          <em><?= $submission->title ?></em>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <strong><a href="<?= site_url('submission') ?>">Lihat Pengajuan Lainnya</a></strong>
              </div>
            <?php } else { ?>
              <div class="card-body text-center">
                Belum ada pengajuan
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card shadow-lg rounded-lg">
            <div class="card-header">
              <h3 class="card-title">Jadwal Sidang Terbaru</h3>
            </div>
            <?php if ($submissions) { ?>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Prodi</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($schedules as $schedule) { ?>
                      <tr>
                        <td><?= $schedule->colleger_nim ?></td>
                        <td><?= $schedule->colleger_name ?></td>
                        <td><?= $schedule->study_program_name ?></td>
                        <td><?= date_time($schedule->date, "date-string-full", " ") ?></td>
                        <td><?= explode(":", $schedule->start_time)[0].":".explode(":", $schedule->start_time)[1]." - ".explode(":", $schedule->end_time)[0].":".explode(":", $schedule->end_time)[1] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer text-center">
                <strong><a href="<?= site_url('schedule') ?>">Lihat Jadwal Lainnya</a></strong>
              </div>
            <?php } else { ?>
              <div class="card-body text-center">
                Belum ada jadwal
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>

    <?php if ($this->app->user()->role === "2") { ?>
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-lg rounded-lg">
            <?php if ($schedule) { ?>
              <div class="card-body">
                <div class="alert rounded-lg alert-success">
                    <i class="icon fas fa-check"></i>
                    Selamat! Jadwal sidang Anda sudah tersedia.
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h6 class="m-0"><strong>Nama Mahasiswa</strong></h6>
                    <p class="mb-2"><?= $schedule->colleger_name ?></p>
                    <h6 class="m-0"><strong>NIM</strong></h6>
                    <p class="mb-2"><?= $schedule->colleger_nim ?></p>
                    <h6 class="m-0"><strong>Program Studi</strong></h6>
                    <p class="mb-2"><?= $schedule->study_program_name ?></p>
                    <h6 class="m-0"><strong>Tanggal / Waktu</strong></h6>
                    <p class="mb-2"><?= date_time($schedule->date, 'day-indo') .", ".date_time($schedule->date, 'date-string-full', " ") ?> / <?= explode(":", $schedule->start_time)[0].":".explode(":", $schedule->start_time)[1]." - ".explode(":", $schedule->end_time)[0].":".explode(":", $schedule->end_time)[1] ?> WIB</p>
                    <h6 class="m-0"><strong>Judul</strong></h6>
                    <p class="mb-2"><?= $schedule->title ?></p>
                  </div>
                  <div class="col-md-6">
                    <h6 class="m-0"><strong>Ketua Penguji</strong></h6>
                    <p class="mb-2"><?= $schedule->lead_tester_name ?></p>
                    <h6 class="m-0"><strong>Penguji Utama</strong></h6>
                    <p class="mb-2"><?= $schedule->main_tester_name ?></p>
                    <h6 class="m-0"><strong>Penguji Pendamping</strong></h6>
                    <p class="mb-2"><?= $schedule->secondary_tester_name ?></p>
                    <h6 class="m-0"><strong>Pembimbing Utama</strong></h6>
                    <p class="mb-2"><?= $schedule->main_lecturer_name ?></p>
                    <h6 class="m-0"><strong>Pembimbing Pendamping</strong></h6>
                    <p class="mb-2"><?= $schedule->secondary_lecturer_name ?></p>
                  </div>
                </div>
              </div>
            <?php } else { ?>
              <div class="card-body text-center">
                <img style="width: 20rem; margin: 20px 0;" src="<?= base_url() ?>assets/img/no-schedule.svg">
                    <h5>Tidak ada jadwal ditemukan</h5>
                <p class="text-gray">Belum dapat jadwal? <a href="<?= site_url('submission') ?>">Tambah/buat</a> pengajuan Anda sekarang!</p>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>

  </div>

</section>