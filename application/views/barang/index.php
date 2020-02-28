 <div class="bradcam_area breadcam_bg overlay">
        <h3>Daftar Menu D`jenius</h3>
        <!-- <h6><b>Tambah Kategori</b></h6>
        <h6><b>Tambah Menu</b></h6> -->
    </div>
    <div class="best_burgers_area">
    <?php foreach ($kategori as $ktg) : ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section_title text-center mb-80">
                        <h3><?= $ktg['nama_kategori'] ?></h3>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $kd_kategori = $ktg['kd_kategori']; ?>
                <?php $bar = $this->Barang_model->getBarang($kd_kategori); ?>
                <?php foreach($bar as $barang) :?>
                <div class="col-xl-6 col-md-6 col-lg-6">
                    <div class="single_delicious d-flex align-items-center">
                        <div class="thumb">
                            <img src="<?= base_url('public/img/burger/1.png')?>" alt="">
                        </div>
                        <div class="info">
                            <h3><?= $barang['nama_barang'] ?></h3>
                            <p>Great way to make your business appear trust and relevant.</p>
                            <span>$5</span>
                        </div>
                    </div>
                </div >
                <?php endforeach; ?>
                
            </div>
        </div> <br><br>
    <?php endforeach; ?>
    </div>
    <?= $this->session->flashdata(); ?>