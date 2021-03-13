<div class="bradcam_area breadcam_bg overlay">
        <h3>Laporan Keuangan</h3>
       
</div>
    <div class="best_burgers_area">
        <div class="container">
            <div class="col-lg-12">
				<br>
				<div class="container-fluid">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="glyphicon glyphicon-road"></i> Laporan Keuangan
							</div>
							<div class="panel-body">
								<div class="col-lg-4 mb-9 pull-right">
									<button type='button' onclick="cetak_laporan()" class='btn btn-warning btn-block' id='CetakStruk'>
									<i class='fa fa-print'></i> Cetak
									</button>
								</div>
								<table style="background-color: white;" class="table table-bordered table-hover " id="tabelKeuangan">
									<tr>
										<th>keterangan</th><th>jumlah(Rp.)</th>
									</tr>
									<tr>
										<td>Modal </td> <td class="text-right">
															<?php if ($modalah <= 0) { $modalah =0 ?>
																<a class="btn btn-success  btn-xs" onclick="tambah_modal_awal()"><i class="glyphicon glyphicon-plus"></i> modal awal</a><input type="hidden" id="modal" value="<?= $modalah ?>">
															<?php }else{?>
															<a class="btn btn-success  btn-xs" onclick="tambah_modal_lagi()"><i class="glyphicon glyphicon-plus"></i> modal lagi</a>
															<?php } ?></span>Rp.<?= number_format($modalah, 0, ',', '.').",-"; ?>
															<input type="hidden" id="modal" value="<?= $modalah ?>">
														</td>
									</tr>
									<tr>
										<td>Pendapatan</td><td class="text-right">Rp.<?= number_format($pendapatan, 0, ',', '.').",-"; ?></td><input type="hidden" id="pendapatan" value="<?= $pendapatan ?>">
									</tr>
									<tr>
										<td>operasional & lain-lain</td><td class="text-right"><?php if($operasional ==0){ $operasional =0; ?><?= $operasional ?><?php }else{?>Rp.<?= number_format($operasional, 0, ',', '.').",-"; ?><?php } ?></td><input type="hidden" id="operasional" value="<?= $operasional ?>">
									</tr>
									<tr>
										<td><b>sisa modal</b></td><td class="text-right"><b>Rp.<?= number_format($modalah+$pendapatan-$operasional, 0, ',', '.').",-"; ?></b></td><input type="hidden" id="sisa" value="<?= $modalah+$pendapatan-$operasional ?>">
									</tr>
								</table>
							</div>
							</div>
						</div>
							<!-- <div class="col-lg-8">
							<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="glyphicon glyphicon-road"></i> Laporan Operasional
							</div>
							<div class="panel-body">
								<div class="row">
								<div class="col-lg-2 mb-9 pull-right">
									<button type='button' onclick="cetak_operasional()" class='btn btn-warning btn-block' id='CetakStruk'>
									<i class='fa fa-print'></i> Cetak
									</button>
								</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
									<table style="background-color: white;" class="table table-bordered table-hover " id="tbOperasional">
										<thead>
											<tr>
												<th>no.</th>
												<th>tanggal</th>
												<th>Nama</th>
												<th>Tipe</th>
												<th>Jumlah</th>
											</tr>
										</thead>
									</table>
									</div>
								</div>
							</div>
							</div>
						</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="glyphicon glyphicon-road"></i> Laporan Laba Rugi
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-1 mb-9 pull-right">
										<button type='button' onclick="cetak_labaRugi()" class='btn btn-warning btn-block' id='CetakStruk'>
										<i class='fa fa-print'></i> Cetak
										</button>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-8">
									Laporan penjualan
									<table style="background-color: white;" class="table table-bordered table-hover " id="LabaRugi">
										<thead>
											<tr>
												<th>#</th>
												<th>Nama Menu</th>
												<th>Jumlah Terjual</th>
												<th>Harga Jual</th>
												<th>Total Pendapatan</th>
											</tr>
										</thead>
									</table>
									</div>
									<div class="col-lg-4">
										Laba RUgi
										<table style="background-color: white;" class="table table-bordered table-hover " id="LabaRugi">
										<thead>
											<tr>
												<th>Keterangan </th>
												<th>Jumlah (Rp.)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Pendapatan</td><td>Rp.<?= number_format($pendapatan, 0, ',', '.').",-"; ?></td>
											</tr>
											<tr>
												<td>Operasional &lain lain</td><td>Rp.<?= number_format($operasional, 0, ',', '.').",-"; ?></td>
											</tr>
											<tr>
												<td><b>Hasil Laba</b></td><td><b>Rp.<?= number_format($pendapatan-$operasional, 0, ',', '.').",-"; ?></b></td>
											</tr>
										</tbody>
									</table>
									</div>
								</div>
							</div>
							</div> 
							</div>
						</div>
					</div>
				</div>
				</div> -->


				<!-- Bootstrap modal -->
				<div class="modal fade" id="modal_form" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title"></h3>
							</div>
							<div class="modal-body form">
								<form action="#" id="form" class="form-horizontal">
									<input type="hidden"  id="kd_keuangan" value="" name="kd_keuangan"/> 
									<div class="form-body">
										<div class="form-group" id="modal_sebe" >
											<label class="control-label col-md-3">Modal Sebelumnya (Rp.)</label>
											<div class="col-md-9">
												<input placeholder="modal Sebelumnya" name="modal_sebe" readonly class="form-control" value="<?= $modalah ?>" type="text">
												<!-- <span class="help-block"></span> -->
											</div>
										</div>
									</div>
									<div class="form-body">
										<div class="form-group">
											<label class="control-label col-md-3">Jumlah modal (Rp.)</label>
											<div class="col-md-9">
												<input placeholder="modal baru" class="form-control" onkeypress="return isNumberKey(event)" name="modal_baru" type="text">
												<span class="help-block"></span>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" id="btnSave" onclick="savemodal()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
							
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
				<!-- End Bootstrap modal -->
			</div>
		</div>
	</div>
