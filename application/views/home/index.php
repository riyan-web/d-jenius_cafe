<div class="slider_area">
        <div class="slider_active owl-carousel">
            <div class="single_slider  d-flex align-items-center slider_bg_1 overlay">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-9 col-md-9 col-md-12">
                            <div class="slider_text text-center">
                                <div class="deal_text">
                                    <span><a href="<?= base_url('transaksi') ?>" autofocus>Pesan</a></span>
                                </div>
                                <h3>We <br>
                                    Have Good</h3>
                                <h4>Idea</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single_slider  d-flex align-items-center slider_bg_2 overlay">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-9 col-md-9 col-md-12">
                            <div class="slider_text text-center">
                                <div class="deal_text">
                                <span><a href="<?= base_url('transaksi') ?>" autofocus>Pesan</a></span>
                                </div>
                                <h3>We <br>
                                    Have Good</h3>
                                <h4>Idea</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
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
                            <img src="<?= base_url('upload/'.$barang['foto'])?>" alt="">
                        </div>
                        <div class="info">
                            <h3><?= $barang['nama_barang'] ?></h3>
                            <p><?= $barang['deskripsi']?></p>
                            <span><?php echo "Rp ".$barang['harga'];?> </span>
                        </div>
                    </div>
                </div >
                <?php endforeach; ?>
                
            </div>
        </div> <br><br>
    <?php endforeach; ?>
    </div>
    <?php $this->session->flashdata(); ?>
        </div>
    </div>

    