<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Admin </b></h3>
    <div class="box-tools pull-right">
    
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-5" style="padding-bottom:8 ;">
        <button class="form-control btn btn-xs btn-primary" onclick="petugas_tambah()"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data (F7)</button>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_admin" class="table table-hover table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama admin</th>
          <th>username</th>
          <th>password</th>
           <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Admin, mengedit dan menghapus. klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div>
<?= $modal_admin?>
<?php show_my_confirm('konfirmasiHapus', 'hapus-dataPetugas', 'Hapus Data Ini?', 'Ya, Hapus Data Ini'); ?>
<script>
  var dataTable;
$(document).ready(function() {
    dataTable = $('#table_admin').DataTable( {
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
        url :"<?= base_url('admin/admin_list'); ?>",
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

  function petugas_tambah()
  {
      save_method = 'tambahPetugas';
      $('#form-petugas')[0].reset(); 
      $('#petugas').modal('show');
      $('.form-msg').html('');
      $('.modal-title').text('Tambah User Admin Baru'); 
  }

  function simpan()
{
    var url;

    if(save_method == 'tambahPetugas') {
        url = "<?= site_url('admin/petugas_tambah')?>";
    } else {
        url = "<?= site_url('admin/petugas_proses_ubah')?>";
    }

    // ajax adding data to database

    var formData = new FormData($('#form-petugas')[0]);
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
                $('#petugas').modal('hide');
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

function petugas_ubah(id)
{
    save_method = 'ubahPetugas';
    $('#form-petugas')[0].reset();
    $('#petugas').modal('show'); 
    $('.form-msg').html('');
    $('.modal-title').text('Ubah Data User Admin');


    //Ajax Load data from ajax
    $.ajax({
        url : "<?= site_url('admin/petugas_ubah')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="nama_lengkap"]').val(data.nama_lengkap);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('gagal menampilkan data');
        }
    });
}

var kdnya;
  $(document).on("click", ".konfirmasiHapus-petugas", function() {
    kdnya = $(this).attr("data-id");
  })
  $(document).on("click", ".hapus-dataPetugas", function() {
    var idnya = kdnya;
    
    $.ajax({
      method: "POST",
      url: "<?= base_url('admin/petugas_hapus'); ?>",
      data: "id=" +idnya
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