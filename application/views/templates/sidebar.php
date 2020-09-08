<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>

        <?php if ($this->session->userdata('role_id') == 1) { ?> <!-- Admin -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Barang</li>
            <!-- <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
              </ul>
            </li> -->
            <li><a class="nav-link" href="<?= base_url('barang') ?>"><i class="fas fa-box"></i> <span>Stok Barang</span></a></li>
            
            <li class="menu-header">User Manager</li>
            <li><a class="nav-link" href="<?= base_url('user')?>"><i class="fas fa-user-check"></i> <span>Data Pengguna</span></a></li>
            <li><a class="nav-link" href="<?= base_url('login/profile')?>"><i class="fas fa-user-circle"></i> <span>Profile</span></a></li>
            <li><a class="nav-link" href="<?= base_url('login/logout')?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>

        <?php } elseif ($this->session->userdata('role_id') == 2) { ?> <!-- Pimpinan -->
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li> 

            <li class="menu-header">Laporan</li>
            <li><a class="nav-link" href="<?= base_url('dashboard/laporan')?>"><i class="fas fa-chart-line"></i> <span>Laporan</span></a></li>

            <li class="menu-header">User Manager</li>
            <li><a class="nav-link" href="<?= base_url('login/profile')?>"><i class="fas fa-user-circle"></i> <span>Profile</span></a></li>
            <li><a class="nav-link" href="<?= base_url('login/logout')?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>

        <?php } else { ?> <!-- Kasir -->
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            
            <li class="menu-header">Data Barang</li>
            <li><a class="nav-link" href="<?= base_url('barang')?>"><i class="fas fa-box"></i> <span>Barang</span></a></li>
            
            <li class="menu-header">Transaksi</li>
            <li><a class="nav-link" href="<?= base_url('transaksi')?>"><i class="fas fa-exchange-alt"></i> <span>Transaksi</span></a></li>
            
            <li class="menu-header">User Manager</li>
            <li><a class="nav-link" href="<?= base_url('login/profile')?>"><i class="fas fa-user-circle"></i> <span>Profile</span></a></li>
            <li><a class="nav-link" href="<?= base_url('login/logout')?>"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>

        <?php } ?>

        


        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <!-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a> -->
        </div>
    </aside>
  </div>