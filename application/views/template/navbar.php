<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-5 col-lg-6">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <?php $role_id = $this->session->userdata('role_id'); ?>
                                <ul id="navigation">
                                    <li><a <?php if (isset($tab1)) echo 'class="active"'; ?> href="<?= base_url('home') ?>">Home </a></li>
                                    <li><a <?php if (isset($tab3)) echo 'class="active"'; ?> href="<?= base_url('Penjualan') ?>">Profile </a></li>
                                    <li><a <?php if (isset($tab2)) echo 'class="active"'; ?> href="#">Our Menu <i class="ti-angle-down"></i></a>
                                        <ul class="submenu">
                                            <li><a href="<?= base_url('Barang') ?>">Food </a></li>
                                            <li><a href="<?= base_url('kategori') ?>">Drinks </a></li>
                                            <li><a href="<?= base_url('Barang') ?>">Snack </a></li>
                                            <li><a href="<?= base_url('Barang') ?>">Barista </a></li>
                                            <li><a href="<?= base_url('Barang') ?>">Shisa </a></li>
                                        </ul>
                                    </li>
                                    <li><a <?php if (isset($tab3)) echo 'class="active"'; ?> href="<?= base_url('Penjualan') ?>">Gallery </a></li>
                                    <li><a <?php if (isset($tab4)) echo 'class="active"'; ?> href="<?= base_url('Pengeluaran') ?>">Contact </a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url('public/img/logo_cafe_2.jpeg') ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                        <div class="book_room">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="<?= base_url('Login'); ?>">
                                            <i class="fa fa-sign-out">Login</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="book_btn d-none d-xl-block">
                                <a class="#" href="#">+10 367 453 7382</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>