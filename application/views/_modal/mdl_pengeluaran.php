<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
    <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h3 style="display:block; text-align:center;" class="modal-title">Data Pengeluaran</h3>
  <br>
  <form id="form-pengeluaran" method="POST">
    <input type="hidden" value="" name="kd_operasional"/> 
    <div class="form-group row">
      <label for="nama_operasional"  class="col-md-3 control-label">Nama Pengeluaran</label>
      <div class="col-md-8">
        <input type="text" class="form-control" id="nama_operasional" name="nama_operasional">
      </div>
    </div>
    <div class="form-group row">
      <label for="deskripsi"  class="col-md-3 control-label">Deskripsi</label>
      <div class="col-md-8">
        <input type="text" class="form-control" id="deskripsi" name="deskripsi">
      </div>
    </div>
    <div class="form-group row">
      <label for="jumlah"  class="col-md-3 control-label">Jumlah</label>
      <div class="col-md-8">
        <input type="text" class="form-control" placeholder="harus angka!" onkeypress='return harusAngka(event)' name="jumlah">
      </div>
    </div>
    <div class="form-group row">
      <label for="tipe"  class="col-md-3 control-label">Jenis Pengeluaran</label>
      <div class="col-md-8">
      <input type="text" class="form-control" id="tipe" name="tipe">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-10 col-md-offset-1">
          <button type="button" id="btnSimpan" class="form-control btn btn-primary" onclick="simpan()"> <i class="glyphicon glyphicon-ok"></i>Simpan</button>
      </div>
    </div>
  </form>
</div>
