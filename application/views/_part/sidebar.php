<aside class="main-sidebar sidebar-no-expand sidebar-light-primary border-right elevation-0">
  <!-- Brand Logo -->
  <a href="<?= site_url('dashboard') ?>" class="brand-link text-center d-flex">
    <img src="<?= base_url() ?>assets/img/logo-fsains.png" alt="Logo" class="brand-image align-self-center">
    <span class="brand-text font-weight-bold text-center">
      JADWAL SIDANG
    </span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= site_url('dashboard') ?>" class="nav-link rounded-lg elevation-0" data-segment="dashboard" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <i class="bx bx-home nav-icon"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <?php if ($this->app->user()->role === "1") { ?>
          <li class="nav-item">
            <a href="<?= site_url('study_program') ?>" class="nav-link rounded-lg elevation-0" data-segment="study_program" data-toggle="tooltip" data-placement="right" title="Program Studi">
              <i class="bx bxs-school nav-icon"></i>
              <p>Program Studi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('classroom') ?>" class="nav-link rounded-lg elevation-0" data-segment="classroom" data-toggle="tooltip" data-placement="right" title="Kelas">
              <i class="bx bx-chalkboard nav-icon"></i>
              <p>Kelas</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('lecturer') ?>" class="nav-link rounded-lg elevation-0" data-segment="lecturer" data-toggle="tooltip" data-placement="right" title="Dosen">
              <i class="bx bx-briefcase nav-icon"></i>
              <p>Dosen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('colleger') ?>" class="nav-link rounded-lg elevation-0" data-segment="colleger" data-toggle="tooltip" data-placement="right" title="Mahasiswa">
              <i class="bx bx-id-card nav-icon"></i>
              <p>Mahasiswa</p>
            </a>
          </li>
        <?php } ?>

        <li class="nav-item">
          <a href="<?= site_url('submission') ?>" class="nav-link rounded-lg elevation-0" data-segment="submission" data-toggle="tooltip" data-placement="right" title="Pengajuan Sidang">
            <i class="bx bx-paper-plane nav-icon"></i>
            <p>Pengajuan Sidang</p>
          </a>
        </li>

        <?php if ($this->app->user()->role === "1") { ?>
          <li class="nav-item">
            <a href="<?= site_url('schedule') ?>" class="nav-link rounded-lg elevation-0" data-segment="schedule" data-toggle="tooltip" data-placement="right" title="Jadwal Sidang">
              <i class="bx bx-spreadsheet nav-icon"></i>
              <p>Jadwal Sidang</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('user') ?>" class="nav-link rounded-lg elevation-0" data-segment="user" data-toggle="tooltip" data-placement="right" title="Pengguna">
              <i class="bx bx-user-circle nav-icon"></i>
              <p>Pengguna</p>
            </a>
          </li>
        <?php } ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>