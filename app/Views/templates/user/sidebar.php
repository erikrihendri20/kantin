<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url('assets/admin-lte/dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KantinSTIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/admin-lte/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->email; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if(session()->role==1 || session()->role==2) : ?>

            <li class="nav-header">DASHBOARD</li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/Home'); ?>" class="nav-link <?= ($active=='Home') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Home
                </p>
              </a>
            </li>

            <li class="nav-header">PENGGUNA</li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/User'); ?>" class="nav-link <?= ($active=='Daftar Pengguna') ? 'active' : ''; ?>">
                <i class="nav-icon far fa-user"></i>
                <p>
                  Daftar Pengguna
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/User/saldoPengguna'); ?>" class="nav-link <?= ($active=='Saldo Pengguna') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Saldo Pengguna
                </p>
              </a>
            </li>
          
          <?php elseif(session()->role==3) :  ?>
            <li class="nav-header">PENJUAL</li>

            <li class="nav-item">
              <a href="<?= base_url('Penjual/Pesanan'); ?>" class="nav-link <?= ($active=='Daftar Pesanan') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  Daftar Pesanan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/Menu'); ?>" class="nav-link <?= ($active=='Daftar Menu') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Daftar Menu
                </p>
              </a>
            </li>
          <?php elseif(session()->role==4): ?>
            <li class="nav-header">PEMBELI</li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/Menu'); ?>" class="nav-link <?= ($active=='Pesan') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Pesan
                </p>
              </a>
            </li>


          <?php endif ?>

          


          <li class="nav-header">OPTIONS</li>


          <li class="nav-item">
            <a href="<?= base_url('Auth/Profil'); ?>" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('Auth/logout'); ?>" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
