<div class="msg" style="display:none;">
  <?= @$this->session->flashdata('msg'); ?>
</div>

<div class="box box-solid box-danger">
  <div class="box-header with-border">
    <h3 class="box-title"><i class="fa fa-book"></i> <b>Daftar Pengeluaran Seluruhnya </b></h3>
    <div class="box-tools pull-right"><h4>Tanggal : <b><?= date('d F Y')?></b></h4></div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="row">
    <div class="col-md-12" style="padding-bottom:8 ;">
    
        <form id="tanggal" method="post">
            <label for="">Tanggal Awal</label> : <input type="text" autocomplete="off" id="tgl_awal" name="tgl_awal" > <label for="">Tanggal Akhir</label> <input type="text" autocomplete="off" id="tgl_akhir" name="tgl_akhir" value="<?= date("d-m-Y") ?>"> <button class="btn-xs btn btn-primary" onclick="tampilkan()"><i class="glyphicon glyphicon-search"></i> Tampilkan</button>
        </form>
        <?php
          if(!empty($_POST['tgl_awal'])) {
            echo "<br>Pengeluaran Dari Tanggal <b>".$_POST['tgl_awal']."</b> Sampai Tanggal <b>".$_POST['tgl_akhir']."</b>";
          }
        ?>
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_pengeluaranall" class="table table-hover table-bordered table-striped">
      <thead >
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Nama </th>
          <th>Jumlah</th>
          <th>Jenis</th>
          <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
        <?php $no =1 ;?>
        <?php foreach ($data_pengeluaran as $peng) : ?>
        <tr>
          <td><?= $no++;?></td>
          <td><?= date("d-m-Y", strtotime($peng['tanggal']))?></td>
          <td><?= $peng['nama_operasional'];?></td>
          <td><?= "Rp " . number_format($peng['jumlah'], 2, ",", ".")?></td>
          <td><?= $peng['tipe']?></td>
          <td><a class="btn btn-info btn-xs" href="javascript:void(0)" title="Detail Pengeluaran"  role="button" onclick="detail_pengeluaran(' .<?= $peng['kd_operasional']?>. ')"><i class="fa fa-list"> Detail</i></a></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Pengeluaran, mengedit dan menghapus. klik tombol pada kolom pilihan.
  </div><!-- box-footer -->
</div>
<script>
$(document).ready(function(){
        $('#table_pengeluaranall').DataTable({
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
      "aaSorting": [[ 1, "desc" ]],
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
      "aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]]
        });
    });
</script>