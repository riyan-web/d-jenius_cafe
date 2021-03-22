<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Pengeluaran Harian </b></h3>
    <div class="box-tools pull-right"><h4>Tanggal : <b><?= date('d F Y')?></b></h4></div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-5" style="padding-bottom:8 ;">
        <button class="form-control btn-xs btn btn-primary" onclick="pengeluaran_tambah()"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_pengeluaran" class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama </th>
          <th>Jumlah</th>
          <th>Jenis</th>
          <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Pengeluaran, mengedit dan menghapus. klik tombol pada kolom pilihan.
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

<?= $modal_pengeluaran;?>
<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPengeluaran', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script>
  var dataTable;
$(document).ready(function() {
    dataTable = $('#table_pengeluaran').DataTable( {
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
        url :"<?= base_url('pengeluaran/pengeluaran_list'); ?>",
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
 
   function effect_msg_form() {
      // $('.form-msg').hide();
      $('.form-msg').show(1000);
      setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
    }

    function effect_msg() {
      // $('.msg').hide();
      $('.msg').show(1000);
      setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
    }

  function reload_table()
  {
      dataTable.ajax.reload(null,false); //refresh table
  }

  function pengeluaran_tambah()
  {
      save_method = 'tambahPengeluaran';
      $('#form-pengeluaran')[0].reset(); 
      $('#pengeluaran').modal('show');
      $('.form-msg').html('');
      $('.modal-title').text('Tambah Data Pengeluaran Baru'); 
  }

  function simpan()
{
    var url;

    if(save_method == 'tambahPengeluaran') {
        url = "<?= site_url('pengeluaran/pengeluaran_tambah')?>";
    } else {
        url = "<?= site_url('pengeluaran/pengeluaran_proses_ubah')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form-pengeluaran')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //jika berhasil
            {
                $('.form-msg').html(data.msg);
                effect_msg_form();
            }
            else
            {
                $('#pengeluaran').modal('hide');
                $('.msg').html(data.msg);
                   effect_msg();
                reload_table();
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal');
        }
    });
}

function pengeluaran_ubah(kd_operasional)
{
    save_method = 'ubahPengeluaran';
    $('#form-pengeluaran')[0].reset();
    $('#pengeluaran').modal('show'); 
    $('.form-msg').html('');
    $('.modal-title').text('Ubah Data pengeluaran');


    //Ajax Load data from ajax
    $.ajax({
        url : "<?= site_url('pengeluaran/pengeluaran_ubah')?>/" + kd_operasional,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kd_operasional"]').val(data.kd_operasional);
            $('[name="nama_operasional"]').val(data.nama_operasional);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="jumlah"]').val(data.jumlah);
            $('[name="tipe"]').val(data.tipe);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal menampilkan data');
        }
    });
}

var kdpeng;
  $(document).on("click", ".konfirmasiHapus-pengeluaran", function() {
    kdpeng = $(this).attr("data-id");
  })
  $(document).on("click", ".hapus-dataPengeluaran", function() {
    var idpeng = kdpeng;
    
    $.ajax({
      method: "POST",
      url: "<?= base_url('pengeluaran/pengeluaran_hapus'); ?>",
      data: "kd_pengeluaran=" +idpeng
    })
    .done(function(data) {
      $('#konfirmasiHapus').modal('hide');
      $('.msg').html(data);
      effect_msg();
      reload_table();
    })
  })

function detail_pengeluaran(kd_operasional) {
    $('#detail-pengeluaran').modal('show'); 
    $('.form-msg').html('');
    $('.modal-title').text('Detail Data pengeluaran');


    //Ajax Load data from ajax
    $.ajax({
        url : "<?= site_url('pengeluaran/pengeluaran_detail')?>/" + kd_operasional,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('#tanggal').html("<b>2o2o2o</b>");
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal menampilkan data');
        }
    });
}


</script>