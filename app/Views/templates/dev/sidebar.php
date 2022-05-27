<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: #17a2b8;">
    <!-- Brand Logo -->
    <a href="<?= base_url(''); ?>" class="brand-link" style="background-color: #17a2b8;">
      <img src="<?= base_url('assets/admin-lte/dist/img/LogoDev.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DevKantin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <?php if(session()->dev_log): ?>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/admin-lte/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->name; ?></a>
        </div>
      </div>
      <?php endif ?>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-header">DEV</li>
            <li class="nav-item">
              <a href="<?= base_url('Dev/Documentation'); ?>" class="nav-link <?= ($active=='Documentation') ? 'active' : ''; ?>">
                <i class="nav-icon far fa-file-code"></i>
                <p>
                  Dokumentasi
                </p>
              </a>
            </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if(session()->dev_user_role==1 || session()->dev_user_role==2) : ?>

            <li class="nav-item">
              <a href="<?= base_url('Dev/Dashboard'); ?>" class="nav-link <?= ($active=='Dashboard Dev') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

          <?php endif ?>

          <li class="nav-header">OPTIONS</li>
          <?php if(!session()->dev_log) : ?>
            <li class="nav-item">
              <a href="<?= base_url('Dev/Auth/login'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-in-alt"></i>
                <p>
                  Masuk
                </p>
              </a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a href="<?= base_url('Dev/Auth/logout'); ?>" class="nav-link">
                <i class="nav-icon fa fa-sign-out-alt"></i>
                <p>
                  Keluar
                </p>
              </a>
            </li>
          <?php endif ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
