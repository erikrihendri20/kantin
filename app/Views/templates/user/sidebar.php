<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-light elevation-4" style="background-color: #17a2b8;">
    <!-- Brand Logo -->
    <a href="<?= base_url(''); ?>" class="brand-link" style="background-color: #17a2b8;">

      <img src="<?= base_url('assets/admin-lte/dist/img/LogoKantin.png'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KantinSTIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= (session()->type_login=="sso") ? session()->photo : base_url('assets/admin-lte/dist/img/user2-160x160.jpg') ; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->name; ?></a>
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
          <li class="nav-item">
              <a class="nav-link">
                <i class="nav-icon far fa-eye"></i>
                <p>
                  Jumlah pengunjung: <?= $visitor; ?>
                </p>
              </a>
          </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if(session()->role==1 || session()->role==2) : ?>

            <li class="nav-header">ADMIN</li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/Dashboard'); ?>" class="nav-link <?= ($active=='Dashboard') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/Report'); ?>" class="nav-link <?= ($active=='Report') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-exclamation"></i>
                <p>
                  Laporan
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

            <?php if(session()->role==1) : ?>
            <li class="nav-item">
              <a href="<?= base_url('Admin/User/devUser'); ?>" class="nav-link <?= ($active=='Daftar Pengguna Dev') ? 'active' : ''; ?>">
                <i class="nav-icon fab fa-dev"></i>
                <p>
                  Daftar Pengguna Dev
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('Admin/User/devApi'); ?>" class="nav-link <?= ($active=='Dev Api') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-key"></i>
                <p>
                  Daftar Api
                </p>
              </a>
            </li>
            <?php endif; ?>
          
          <?php elseif(session()->role==3) :  ?>
            <li class="nav-header">PENJUAL</li>

            <li class="nav-item">
              <a href="<?= base_url('Penjual/Order'); ?>" class="nav-link <?= ($active=='Order') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  Daftar Pesanan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/Pay'); ?>" class="nav-link <?= ($active=='Pay') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                  Membayar
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/MyCanteen'); ?>" class="nav-link <?= ($active=='My Canteen') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-store-alt"></i>
                <p>
                  Kantinku
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

            <li class="nav-header">PENJUAL</li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/Dashboard'); ?>" class="nav-link <?= ($active=='Dashboard') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/Rating'); ?>" class="nav-link <?= ($active=='Rating') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-star"></i>
                <p>
                  Penilaian
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Penjual/HistoryTransaction'); ?>" class="nav-link <?= ($active=='History Transaction') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat
                </p>
              </a>
            </li>
            
          <?php elseif(session()->role==4): ?>
            <li class="nav-header">PEMBELI</li>
            <li class="nav-item">
              <a href="<?= base_url('Pembeli/Order'); ?>" class="nav-link <?= ($active=='Order') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                  Pesan
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('Pembeli/Checkout'); ?>" class="nav-link <?= ($active=='Checkout') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Keranjang
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="<?= base_url('Pembeli/WaitingList'); ?>" class="nav-link <?= ($active=='WaitingList') ? 'active' : ''; ?>">
                <i class="nav-icon far fa-clock"></i>
                <p>
                  Tunggu Pesanan
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('Pembeli/History'); ?>" class="nav-link <?= ($active=='History') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-history"></i>
                <p>
                  Riwayat
                </p>
              </a>
            </li>

          <?php endif ?>

          


          <li class="nav-header">OPTIONS</li>


          <li class="nav-item">
            <a href="<?= base_url('Auth/Profile'); ?>" class="nav-link <?= ($active=='Profile') ? 'active' : ''; ?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <?php if(session()->role==1||session()->role==2): ?>
              <a href="<?= base_url('Admin/Testimonial'); ?>" class="nav-link <?= ($active=='Testimonial') ? 'active' : ''; ?>">
            <?php elseif(session()->role==3): ?>
              <a href="<?= base_url('Penjual/Testimonial'); ?>" class="nav-link <?= ($active=='Testimonial') ? 'active' : ''; ?>">
            <?php else: ?>
              <a href="<?= base_url('Pembeli/Testimonial'); ?>" class="nav-link <?= ($active=='Testimonial') ? 'active' : ''; ?>">
            <?php endif ?>
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
                Kritik dan Saran
              </p>
            </a>
          </li>
          <li class="nav-item">
            <?php if(session()->role==1||session()->role==2): ?>
              <a href="<?= base_url('Admin/Info'); ?>" class="nav-link <?= ($active=='Info') ? 'active' : ''; ?>">
            <?php elseif(session()->role==3): ?>
              <a href="<?= base_url('Penjual/Info'); ?>" class="nav-link <?= ($active=='Info') ? 'active' : ''; ?>">
            <?php else: ?>
              <a href="<?= base_url('Pembeli/Info'); ?>" class="nav-link <?= ($active=='Info') ? 'active' : ''; ?>">
            <?php endif ?>
              <i class="nav-icon fas fa-info"></i>
              <p>
                Informasi
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
