<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Menu</b></h3>
    <div class="box-tools pull-right">
    
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-5" style="padding-bottom:8 ;">
        <button class="form-control btn-xs btn btn-primary" onclick="menu_tambah()"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_menu" class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Menu</th>
          <th>Harga</th>
          <th>Kategori</th>
          <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Menu, mengedit dan menghapus. klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Grafik Penjualan Seluruh Barang</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div style="width: 800px;height: 400px">
      <canvas id="myChart"></canvas>
    </div>
  </div><!-- /.box-body -->
</div>
<?= $modal_menu;?>
<?php show_my_confirm('konfirmasiHapus', 'hapus-dataMenu', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script>
  var dataTable;
$(document).ready(function() {
    dataTable = $('#table_menu').DataTable( {
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
        url :"<?= base_url('barang/menu_list'); ?>",
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

  function menu_tambah()
  {
      save_method = 'tambahMenu';
      $('#form-menu')[0].reset(); 
      $('#menu').modal('show');
      $('.form-msg').html('');
      $('.modal-title').text('Tambah Menu Baru'); 
  }

  function simpan()
{
    var url;

    if(save_method == 'tambahMenu') {
        url = "<?= site_url('barang/menu_tambah')?>";
    } else {
        url = "<?= site_url('barang/menu_proses_ubah')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form-menu')[0]);
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
                $('#menu').modal('hide');
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

function menu_ubah(kd_barang)
{
    save_method = 'ubahMenu';
    $('#form-menu')[0].reset();
    $('#menu').modal('show'); 
    $('.form-msg').html('');
    $('.modal-title').text('Ubah Data Menu');


    //Ajax Load data from ajax
    $.ajax({
        url : "<?= site_url('barang/menu_ubah')?>/" + kd_barang,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kd_barang"]').val(data.kd_barang);
            $('[name="nama_barang"]').val(data.nama_barang);
            $('[name="harga"]').val(data.harga);
            $('[name="kategori"]').val(data.kd_kategori);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal menampilkan data');
        }
    });
}

var kdbar;
  $(document).on("click", ".konfirmasiHapus-barang", function() {
    kdbar = $(this).attr("data-id");
  })
  $(document).on("click", ".hapus-dataMenu", function() {
    var idbar = kdbar;
    
    $.ajax({
      method: "POST",
      url: "<?= base_url('barang/menu_hapus'); ?>",
      data: "kd_barang=" +idbar
    })
    .done(function(data) {
      $('#konfirmasiHapus').modal('hide');
      $('.msg').html(data);
      effect_msg();
      reload_table();
    })
  })


</script>