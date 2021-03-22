<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;" class="modal-title">Data Kategori</h3>
<br>
  <form id="form-kategori" method="POST">
    <input type="hidden" value="" name="kd_kategori"/> 
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="fa fa-users"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" onkeypress='return harusHuruf(event)' aria-describedby="sizing-addon2">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="button" id="btnSimpan" class="form-control btn btn-primary" onclick="simpan()"> <i class="glyphicon glyphicon-ok"></i>Simpan</button>
      </div>
    </div>
  </form>
</div>