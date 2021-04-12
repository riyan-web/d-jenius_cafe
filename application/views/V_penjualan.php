<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Penjualan Harian </b></h3>
    <div class="box-tools pull-right"><h4>Tanggal : <b><?= date('d F Y')?></b></h4></div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-5" style="padding-bottom:8 ;">
        <button class="form-control btn-xs btn btn-info" onclick="penjualan_cek()"><i class="fa fa-check"></i> <b>Cek Hasil Penjualan Hari ini</b></button>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_penjualan" class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal </th>
          <th>Kode jual</th>
          <th>Jumlah Total </th>
          <th>Total Harga</th>
          <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Penjualan, klik tombol pada kolom pilihan. Serta dapat mengecek pendapatan harian
  </div><!-- box-footer -->
</div>

<script>
  var dataTable;
$(document).ready(function() {
    dataTable = $('#table_penjualan').DataTable( {
      "serverSide": true,
      "stateSave" : false,
      "bAutoWidth": true,
      "oLanguage": {
        "sSearch": "<i class='fa fa-search fa-fw'></i> Pencarian : ",
        "sLengthMenu": "_MENU_ &nbsp;&nbsp;Data Per Halaman ",
        "sInfo": "Menampilkan _START_ s/d _END_ dari <b>_TOTAL_ data</b>",
        "sInfoFiltered": "(difilter dari _MAX_ total data)", 
        "sZeroRecords": "Pencarian tidak ditemukan", 
        "sEmptyTable": "Data kosong", 
        "sLoadingRecords": "Harap Tunggu...", 
        "oPaginate": {
          "sPrevious": "Sebelumnya",
          "sNext": "Selanjutnya"
        }
      },
      "aaSorting": [[ 0, "desc" ]],
      "columnDefs": [ 
        {
          "targets": 'no-sort',
          "orderable": false,
        },
        { 
          "targets": [ -1 ],
          "orderable": false, 
        },
          ],
      "sPaginationType": "simple_numbers", 
      "iDisplayLength": 10,
      "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
      "ajax":{
        url :"<?= base_url('penjualan/penjualan_list'); ?>",
        type: "post",
        error: function(){ 
          $(".my-grid-error").html("");
          $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#my-grid_processing").css("display","none");
        }
      }
      <?php
      if ($this->session->flashdata('msg') != '') {
        echo "effect_msg();";
      }
    ?>
    } );

  });
  function penjualan_cek()
  {
      save_method = 'cekPenjualan';
      $('#form-penjualan')[0].reset(); 
      $('#penjualan').modal('show');
      $('.form-msg').html('');
  }
  </script>

<div class="modal fade" id="penjualan" role="dialog">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
        <div class="form-msg"></div>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 style="display:block; text-align:center;" class="modal-title">Hasil Penjualan Hari ini </b></h3>
        <br>
        <form id="form-penjualan" method="POST">
          <div class="form-group row">
            <label for="jumlah"  class="col-md-4">Tanggal</label>
            <div class="col-md-5">
              <b><?=date('d F Y, h:i:s')?>
            </div>
          </div>
          <div class="form-group row">
            <label for="total"  class="col-md-4 control-label">Jumlah Terjual</label>
            <div class="col-md-8">
            <?= $data_penjualan->jumlah_semua; ?>&nbsp;<label> buah</label>
            </div>
            
          </div>
          <div class="form-group row">
            <label for="total"  class="col-md-4 control-label">Total Penjualan </label>
            <div class="col-md-8">
            <?= "Rp " . number_format($data_penjualan->total, 2, ",", "."); ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button type="button" class="form-control btn btn-danger" data-dismiss="modal" aria-label="Close">Tutup</button>
            </div>
          </div>
        </form>
      </div>
		</div>
	</div>
</div>