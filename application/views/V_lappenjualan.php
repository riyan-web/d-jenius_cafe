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
    </div>
    </div>
    <div class="form-group"></div>
    <table id="table_pengeluaranall" class="table table-hover table-bordered table-striped">
      <thead >
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Kd Jual </th>
          <th>Jumlah Beli</th>
          <th>Total Harga</th>
          <th style="text-align: center;">Pilihan</th>
        </tr>
      </thead>
      <tbody>
        <?php $no =1 ;?>
        <?php foreach ($data_penjualan as $peng) : ?>
        <tr>
          <td><?= $no++;?></td>
          <td><?= date("d-m-Y", strtotime($peng['tanggal']))?></td>
          <td><?= $peng['kd_jual'];?></td>
          <td><?= $peng['jumlah_total'];?></td>
          <td class="text-right"><?= "Rp " . number_format($peng['total_harga'], 2, ",", ".")?></td>
          <td><a class="btn btn-info btn-xs" href="javascript:void(0)" title="Detail Pengeluaran"  role="button" onclick="detail_pengeluaran(' .<?= $peng['kd_jual']?>. ')"><i class="fa fa-list"> Detail</i></a></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="box-footer">
    Menampilkan daftar Penjualan seluruhnya.
  </div><!-- box-footer -->
</div>
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div style="width: 800px;height: 800px">
              <canvas id="myChart"></canvas>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
  <script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: 'Grafik Penjualan',
					data: ['8', '9', '10', '11', '6', '5', '4'],
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
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