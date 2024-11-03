<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
        <i class="bx bx-fullscreen bx-sm"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Select -->
    <!-- <li class="nav-item">
      <div class="form-group mb-0">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="bx bx-store"></i></span>
          </div>
          <select class="form-control select nav-select">
            <option value="">Semua Toko</option>
            <option value="">Pusat</option>
          </select>
        </div>
      </div>
    </li> -->

    <!-- Notifications Dropdown Menu -->
    <!-- <li class="nav-item dropdown notification">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="bx bx-bell bx-sm bx-tada"></i>
        <span class="badge badge-warning navbar-badge">15</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-2 rounded-lg shadow-dark-lg">
        <span class="dropdown-item dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item bg-soft-primary" style="text-wrap: wrap;">
          <div class="row">
            <p>Tim <strong>HARIMAU</strong> sudah di lokasi patroli</p>
          </div>
          <div class="row justify-content-between">
            <p class="mt-2" style="font-size: 12px;">
              <i class="fas fa-map-marker-alt text-primary"></i> <em>Cengkareng</em>
            </p>
            <p class="mt-2" style="font-size: 12px;">
              3 menit
            </p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
      </div>
    </li> -->

    <!-- User Dropdown Menu -->
    <li class="nav-item dropdown user-menu">
      <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" aria-expanded="false">
        <span class="row user-image img-circle bg-primary text-white justify-content-center align-items-center">
          <?= initials($this->app->user()->name) ?>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right rounded-lg shadow-dark-lg border-0 py-2 shadow-lg">
        <span class="dropdown-header">
          <strong><?= $this->app->user()->name ?></strong> <br> Admin
        </span>
        <div class="dropdown-divider"></div>
        <!-- <a href="javascript:void(0)" class="dropdown-item d-flex align-items-center">
          <i class="bx bx-user-circle mr-2"></i> Profile
        </a> -->
        <!-- <div class="dropdown-divider"></div> -->
        <a href="<?= site_url('auth/logout') ?>" id="onLogout" class="dropdown-item d-flex align-items-center mb-2">
          <i class="bx bx-power-off mr-2"></i> Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>