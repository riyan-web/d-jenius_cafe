<div class="bradcam_area breadcam_bg overlay">
    <h3>Laporan Penjualan</h3>

</div>
<br><br><br>
<div class="container">
    <div class="card card-default">
        <div id="penjualanSemua"></div>
    </div><br><br>
    <div class="card card-default">
        <div></div>
    </div>
</div>

<!-- <?php
        print_r($jml_barang);
        ?> -->

<script src="<?= base_url('public/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('public/highcharts/exporting.js') ?>"></script>
<script src="<?= base_url('public/highcharts/export-data.js') ?>"></script>
<script src="<?= base_url('public/highcharts/accessibility.js') ?>"></script>
<script type="text/javascript">
    Highcharts.chart('penjualanSemua', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Penjualan Seluruhnya'
        },
        xAxis: {
            categories: ['Nama Menu'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'jumlah Terjual'
            }
        },
        series: [
            <?php foreach ($jml_barang as $dataPenjualan) : ?>

                name: "<?= $dataPenjualan['nama_barang'] ?>",
                data: [<?= $dataPenjualan['jumlah']; ?>],
            <?php endforeach; ?>
        ]
    });
</script>