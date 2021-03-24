<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url(); ?>upload/<?= $this->session->userdata['foto'] ?>" class="img-circle" alt="User Image"> 
        <!-- gambar ambil dari session -->
      </div>
      <div class="pull-left info">
        <p><?= $this->session->userdata['nama_lengkap'] ?></p>
        <!-- Status -->
        <a href="<?= base_url(); ?>dashboard"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Home</li>
         <li <?php if ($page == 'dashboard') {echo 'class="active"';} ?>>
          <a href="<?= base_url('dashboard');?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
      <li class="header">Master Data</li>
      <li <?php if ($page == 'barang') {echo 'class="active"';} ?>>
        <a href="<?= base_url('barang');?>">
          <i class="fa fa-book"></i> <span>Data Menu / Barang</span>
        </a>
      </li>
      <li <?php if ($page == 'kategori') {echo 'class="active"';} ?>>
        <a href="<?= base_url('kategori');?>">
          <i class="fa fa-tags"></i> <span>Data Kategori Menu</span>
        </a>
      </li>

      <li class="header">Transaksi</li>
      <li <?php if ($page == 'pengeluaran') {echo 'class="active"';} ?>>
        <a href="<?= base_url('pengeluaran'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Pengeluaran</span>
        </a>
      </li>
      <li <?php if ($page == 'penjualan') {echo 'class="active"';} ?>>
        <a href="<?= base_url('penjualan'); ?>">
          <i class="fa fa-shopping-cart"></i>
          <span>Penjualan</span>
        </a>
      </li>
            
      <li <?php if ($page == 'laporan') {echo 'class="treeview active"';} ?>>
        <a>
          <i class="fa fa-location-arrow"></i>
          <span>Laporan</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($pagae == 'lappengeluaran') {echo 'class="active"';} ?>>
            <a href="<?= base_url('laporan/pengeluaran'); ?>">
              <i class="fa fa-circle-o"></i>Laporan Pengeluaran
            </a>
          </li>
          <li <?php if ($pagae == 'lappenjualan') {echo 'class="active"';} ?>>
            <a href="<?= base_url('laporan/penjualan'); ?>">
              <i class="fa fa-circle-o"></i>Laporan Penjualan
            </a>
          </li>
          <li <?php if ($pagae == 'laplabarugi') {echo 'class="active"';} ?>>
            <a href="<?= base_url('laporan/labarugi'); ?>"><i class="fa fa-circle-o"></i>Laporan Laba rugi
            </a>
          </li>
        </ul>
      </li>
      <li class="header">PETUGAS/KARYAWAN</li>
      <li <?php if ($page == 'datapetugas') {echo 'class="active"';} ?>>
        <a href="<?= base_url('admin/petugas'); ?>">
          <i class="fa fa-user-plus"></i>
          <span>Petugas</span>
        </a>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>