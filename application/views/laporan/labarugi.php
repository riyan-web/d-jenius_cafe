<div class="bradcam_area breadcam_bg overlay">
        <h3>Laporan Keuangan</h3>
       
</div>
    <div class="best_burgers_area">
        <div class="container">
            <div class="col-lg-12">
			<br>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="glyphicon glyphicon-road"></i> Laporan Laba Rugi
                            </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2 mb-9 pull-right">
                                            <button type='button' onclick="cetak_labaRugi()" class='btn btn-warning btn-block' id='CetakStruk'><i class='fa fa-print'></i> Cetak</button>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
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
</div>