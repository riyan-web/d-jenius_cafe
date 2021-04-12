<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Data Laba Rugi</b></h3>
    <div class="box-tools pull-right"><h4>Tanggal : <b><?= date('d F Y')?></b></h4></div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="form-group"></div>
    <div class="col-md-8 col-md-offset-2" >
    <form id="tanggal" method="post">
            <label for="">Tanggal Awal</label> : <input type="text" autocomplete="off" id="tgl_awal" name="tgl_awal" > <label for="">Tanggal Akhir</label> <input type="text" autocomplete="off" id="tgl_akhir" name="tgl_akhir" value="<?= date("d-m-Y") ?>"> <button class="btn-xs btn btn-primary" onclick="tampilkan()"><i class="glyphicon glyphicon-search"></i> Tampilkan</button>
        </form>
        <?php
          if(!empty($_POST['tgl_awal'])) {
            echo "<br><h4>Pengeluaran Dari Tanggal <b>".$_POST['tgl_awal']."</b> Sampai Tanggal <b>".$_POST['tgl_akhir']."</b></h4>";
          }
        ?>
        <br><br>
    <table id="table_pengeluaran" class="table table-hover table-bordered">
        <tr class="bg-warning"> 
            <th>Keterangan</th>
            <th>Jumlah(Rp.)</th>
        </tr>
        <tr>
            <th>Jumlah Seluruh Penjualan</th>
            <td><?= "Rp " . number_format($penjualan->jumlah_semua, 2, ",", "."); ?></td>
        </tr>
        <tr>
            <th>Jumlah Seluruh Pengeluaran</th>
            <td><?= "Rp " . number_format($pengeluaran->jumlah_semua, 2, ",", "."); ?></td>
        </tr>
        <tr>
            <th>Total</th>
            <td><?="Rp " . number_format($penjualan->jumlah_semua-$pengeluaran->jumlah_semua, 2, ",", ".");?> </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="box-footer">
    Menampilkan data Laba Rugi.
  </div><!-- box-footer -->
</div>

<div class="modal fade" id="detail-pengeluaran" role="dialog">
	<div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 style="display:block; text-align:center;" class="modal-title">Data Pengeluaran</h3>
            </div>
            <div class="modal-body table-responsive">
                <table>
                    <tbody>
                        <tr>
                            <th>Tanggal</th>
                            <td><span id="tanggal"></span></td>
                        </tr>
                        <tr>
                            <th>Nama Pengeluaran</th>
                            <td><span id="nama_operasional"></span></td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><span id="deskripsi"></span></td>
                        </tr>
                        <tr>
                            <th>jumlah</th>
                            <td><span id="jumlah"></span></td>
                        </tr>
                        <tr>
                            <th>jenis</th>
                            <td><span id="jenis"></span></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>             
	    </div>
    </div>
</div>