  
<br><br><br><br>
<div class="container-fluid">
  <div class="panel panel-default">
    <div class="panel-body">
    <div class="row">
      <div class="col-lg-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
              <i class="glyphicon glyphicon-road"></i> Informasi Nota
          </div>
            <div class="panel-body" bgcolor="yellow">
                <div class="form-group">
                  <label>No. Nota  :</label>
                  <input style="width: 160px;" name="kd_transaksi" id="kd_transaksi" readonly value="<?= $nota ?>" type="text">
                </div>
                <div class="form-group">
                  <label>Tanggal&nbsp;</label>&nbsp;<b>:</b>
                  <input style="width: 160px;" name="tanggal" id="tanggal" type="text" readonly value="<?= date("Y/m/d") ?>" required>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-12">
            <h5 class='judul-transaksi'>
              <i class='fa fa-shopping-cart fa-fw'></i> Transaksi <i class='fa fa-angle-right fa-fw'></i> Penjualan
              <a href="<?= site_url('transaksi'); ?>" class='pull-right'><i class='fa fa-refresh fa-fw'></i> Refresh Halaman</a>
              <table class='table table-bordered' id='TabelTransaksi'>
              <thead>
                <tr bgcolor="brown">
                  <th style='width:35px;'>#</th>
                  <th style='width:210px;'>Kode Barang</th>
                  <th>Nama Menu</th>
                  <th style='width:120px;'>Harga</th>
                  <th style='width:75px;'>Qty</th>
                  <th style='width:125px;'>Sub Total</th>
                  <th style='width:40px;'></th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>

            <div class='alert alert-info TotalBayar'>
              <button id='BarisBaru' class='btn btn-default pull-left'><i class='fa fa-plus fa-fw'></i> Baris Baru (F7)</button>
              <h2 class="text-right">Total : <span id='TotalBayar'>Rp. 0</span></h2>
              <input type="hidden" id='TotalBayarHidden'>
            </div>
            </h5>
          </div>
        </div>
        <div class="row">
          <div class='col-sm-7'>
                <textarea name='catatan' id='catatan' class='form-control' rows='2' placeholder="Catatan Transaksi (Jika Ada)" style='resize: vertical; width:83%;'></textarea>
                
                <br />
                <p><i class='fa fa-keyboard-o fa-fw'></i> <b>Shortcut Keyboard : </b></p>
                <div class='row'>
                  <div class='col-sm-6'>F7 = Tambah baris baru</div>
                  <div class='col-sm-6'>F9 = Cetak Struk</div>
                  <div class='col-sm-6'>F8 = Fokus ke field bayar</div>
                  <div class='col-sm-6'>F10 = Simpan Transaksi</div>
                </div> 
              </div>
              <div class='col-sm-5'>
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-6 control-label">Bayar (F8)</label>
                    <div class="col-sm-6">
                      <input type='text' name='cash' id='UangCash' class='form-control' onkeypress='return isNumberKey(event)'>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-6 control-label">Kembali</label>
                    <div class="col-sm-6">
                      <input type='text' id='UangKembali' class='form-control' disabled>
                    </div>
                  </div>
                  <div class='row'>
                    <div class='col-sm-6' style='padding-right: 0px;'>
                      <button type='button' class='btn btn-warning btn-block' id='CetakStruk'>
                        <i class='fa fa-print'></i> Cetak (F9)
                      </button>
                    </div>
                    <div class='col-sm-6'>
                      <button type='button' class='btn btn-primary btn-block' id='Simpann'>
                        <i class='fa fa-floppy-o'></i> Simpan (F10)
                      </button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
      <!-- tutup col -->
    </div>
    <!-- tutup row -->
  </div>
</div>
</div>
<!-- tutup container -->

