<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="<?= base_url(); ?>public/backend/#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">

    <ul class="nav navbar-nav">
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 4 messages</li>
        </ul>
      </li>

      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
        </ul>
      </li>

      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="<?= base_url(); ?>assets/#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="<?= base_url(); ?>upload/<?= $this->session->userdata['foto'] ?>" class="user-image" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs"><?= $this->session->userdata['nama_lengkap'] ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img src="<?= base_url(); ?>upload/<?= $this->session->userdata['foto'] ?>" class="img-circle" alt="User Image">
            <!-- ini dari session nantinya -->

            <p>
              <?= $this->session->userdata['nama_lengkap'] ?> - Pustakwan
              <small>bekerja dari tanggal Maret, 2018</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="<?= base_url('Login/Profile'); ?>" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="<?= base_url('Login/logout'); ?>" class="btn btn-default btn-flat">Keluar</a>
            </div>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>