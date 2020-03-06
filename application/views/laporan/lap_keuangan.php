<div class="bradcam_area breadcam_bg overlay">
        <h3>Laporan Keuangan</h3>
        <!-- <h6><b>Tambah Kategori</b></h6>
        <h6><b>Tambah Menu</b></h6> -->
        </div>
        <div id="page-wrapper">
        <br>
          <div class="row">
               <!--page header-->
              <div class="col-lg-12">
                <div align="center">
                  <a style="margin-bottom:10px" href="lap_keuangan.php" class="btn btn-danger btn-xs pull-left"><b><span class='fa fa-print'></span> Cetak PDF</b></a>
                          <div class="row">
                              <div class="col-lg-12">
                                  <div class="panel-body">
                                      <div class="table-responsive">
									  <?php foreach($keuangan as $u){ ?>
                                          <table style="background-color: yellow;" class="table table-bordered table-hover " id="tabel">
                                              <tr>
                                                  <th><h3 style="color: blue;">Modal</h3><a href="history_modal.php" class="pull-right btn btn-success btn-xs" title="semua data modal yang ditambahkan"><i class="fa fa-book"></i></a></th>
                                                  <td class="text-right"> <span class="text-left">
                                                  <a href="tambah_modal.php" class="btn btn-primary btn-xs" title="tambah modal awal">Tambah Modal</a></span><h3 style="color: blue;">Rp.0000000</h3></td>
                                              </tr>      
                                              <tr>
                                                  <th><h3 style="color: blue;">Pengeluaran</h3></th>
                                                  <td class="text-right">20.000</td>
                                                  
                                              </tr>
                                            
                                              <tr>
                                                  <th><h3 style="color: blue;">Pemasukan</h3></th>
                                                  <td class="text-right">Rp.</td>
                                                  
                                              
                                              <tr>
                                                  <th><h3 style="color: blue;">Piutang</h3></th>
                                              </tr>
                                              
                                              <tr>
                                                  <th><h3 style="color: blue;">Hutang</h3></th>
                                              </tr>
                                              
                                              <tr>
                                                  <th><h3 style="color: blue;">Operasional</h3></th>
                                              </tr>
                                
                                              <tr>
                                                  <th><h3 style="color: blue;">Inventaris</h3></th>
                                              </tr>
                                              <tr>
                                                  <th><h3 style="color: blue;">Sisa Modal</h3></th>
                                            
                                                  <th><?php echo $u->sisa_modal ?></th>
                                              </tr>

                                          </table>
										  <?php } ?>

                                          </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                </div>   
            </div>