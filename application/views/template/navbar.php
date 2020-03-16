    <!-- header-start -->
        <header>
            <div class="header-area ">
                <div id="sticky-header" class="main-header-area">
                    <div class="container-fluid p-0">
                        <div class="row align-items-center no-gutters">
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a <?php if(isset($tab1)) echo 'class="active"'; ?> href="<?= base_url() ?>">home</a></li>
                                            <li><a <?php if(isset($tab2)) echo 'class="active"'; ?> href="<?= base_url('barang') ?>">Daftar Menu</a></li>
                                            <li><a <?php if(isset($tab3)) echo 'class="active"'; ?> href="#">Master Data<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="<?= base_url('Master_data') ?>">Tambah Menu</a></li>
                                                    <li><a href="<?= base_url('kategori') ?>">Tambah Kategori</a></li>
                                                </ul>
                                            </li>
                                            <li><a <?php if(isset($tab4)) echo 'class="active"'; ?> href="<?= base_url('transaksi') ?>">Transaksi</a></li>
                                            <li><a <?php if(isset($tab5)) echo 'class="active"'; ?> href="#">Laporan <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Laporan Laba rugi</a></li>
                                                    <li><a href="<?= base_url('barang/lap_keuangan') ?>">Laporan Keuangan</a></li>
                                                    <li><a href="blog.html">Laporan Operasional</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Operasional</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1">
                                <div class="logo-img">
                                    <a href="<?= base_url() ?>">
                                    <img src="<?= base_url('public/img/logo_cafe_2.jpeg')?>" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                                <div class="book_room">
                                    <div class="socail_links">
                                        <ul>
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