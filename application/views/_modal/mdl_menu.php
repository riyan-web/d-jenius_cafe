<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
    <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;" class="modal-title">Data Menu</h3>
  <br>
  <form id="form-menu" method="POST">
    <input type="hidden" value="" name="kd_barang"/> 
    <div class="form-group row">
      <label for="nama_barang"  class="col-md-3 control-label">Nama Menu</label>
      <div class="col-md-8">
        <input type="text" class="form-control" name="nama_barang">
      </div>
    </div>
    <div class="form-group row">
      <label for="harga"  class="col-md-3 control-label">Harga</label>
      <div class="col-md-8">
        <input type="text" class="form-control" placeholder="harus angka!" onkeypress='return harusAngka(event)' name="harga">
      </div>
    </div>
    <div class="form-group row">
      <label for="kategori"  class="col-md-3 control-label">Kategori</label>
      <div class="col-md-8">
        <select name="kategori" class="form-control select2">
        <option value="">Pilih Kategori </option>
        <?php
        foreach ($data_kategori as $kat) {
          ?>
          <option value="<?= $kat['kd_kategori'] ?>">
            <?= $kat['nama_kategori']; ?>
          </option>
          <?php
        }
        ?>
      </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-10 col-md-offset-1">
          <button type="button" id="btnSimpan" class="form-control btn btn-primary" onclick="simpan()"> <i class="glyphicon glyphicon-ok"></i>Simpan</button>
      </div>
    </div>
  </form>
</div>
