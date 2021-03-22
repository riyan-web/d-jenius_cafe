<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Kategori </b></h3>
    <div class="box-tools pull-right">
    
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-5" style="padding-bottom:8 ;">
        <button class="form-control btn btn-xs btn-primary" onclick="kategori_tambah()"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data (F7)</button>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_kategori" class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Kategori</th>
           <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Kategori, mengedit dan menghapus. klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div>
<?= $modal_kategori?>
<?php show_my_confirm('konfirmasiHapus', 'hapus-dataKategori', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script>
  var dataTable;
$(document).ready(function() {
    dataTable = $('#table_kategori').DataTable( {
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
        url :"<?= base_url('kategori/kategori_list'); ?>",
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

  function kategori_tambah()
  {
      save_method = 'tambahKategori';
      $('#form-kategori')[0].reset(); 
      $('#kategori').modal('show');
      $('.form-msg').html('');
      $('.modal-title').text('Tambah Kategori Baru'); 
  }

  function simpan()
{
    var url;

    if(save_method == 'tambahKategori') {
        url = "<?= site_url('kategori/kategori_tambah')?>";
    } else {
        url = "<?= site_url('kategori/kategori_proses_ubah')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form-kategori')[0]);
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
                $('#kategori').modal('hide');
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

function kategori_ubah(kd_ketegori)
{
    save_method = 'ubahKategori';
    $('#form-kategori')[0].reset();
    $('#kategori').modal('show'); 
    $('.form-msg').html('');
    $('.modal-title').text('Ubah Data Kategori');


    //Ajax Load data from ajax
    $.ajax({
        url : "<?= site_url('kategori/kategori_ubah')?>/" + kd_ketegori,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kd_kategori"]').val(data.kd_kategori);
            $('[name="nama_kategori"]').val(data.nama_kategori);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal menampilkan data');
        }
    });
}

var kdnya;
  $(document).on("click", ".konfirmasiHapus-kategori", function() {
    kdnya = $(this).attr("data-id");
  })
  $(document).on("click", ".hapus-dataKategori", function() {
    var id = kdnya;
    
    $.ajax({
      method: "POST",
      url: "<?= base_url('kategori/kategori_hapus'); ?>",
      data: "kd_ketegori=" +id
    })
    .done(function(data) {
      $('#konfirmasiHapus').modal('hide');
      $('.msg').html(data);
      effect_msg();
      reload_table();
    })
  })

  $(document).on('keydown', 'body', function(e) {
    var charCode = (e.which) ? e.which : event.keyCode;

    if (charCode == 118) //F7
    {
      kategori_tambah();
      return false;
    }
  });


</script>