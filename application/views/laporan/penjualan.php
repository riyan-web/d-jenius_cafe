
<div class="bradcam_area breadcam_bg overlay">
        <h3>Laporan Penjualan</h3>
       
</div>
<div id="container"></div>

<?php
print_r($jml_barang);
?>

<script src="<?= base_url('public/highcharts/highcharts.js')?>"></script>
<script src="<?= base_url('public/highcharts/exporting.js')?>"></script>
<script src="<?= base_url('public/highcharts/export-data.js')?>"></script>
<script src="<?= base_url('public/highcharts/accessibility.js')?>"></script>
<script type = "text/javascript">
    Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Data Penjualan Per Minggu'
    },
    subtitle: {
        text: 'Berdasarkan Hasil Data Penjualan Cafe'
    },
    xAxis: {
        categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Billions'
        },
        labels: {
            formatter: function () {
                return this.value / 100;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' millions'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    },
    series: [{
        name: 'Asia',
        data: [502, 635, 809, 947, 1402, 3634, 5268]
    }, {
        name: 'Africa',
        data: [106, 107, 111, 133, 221, 767, 1766]
    }, {
        name: 'Europe',
        data: [163, 203, 276, 408, 547, 729, 628]
    }, {
        name: 'America',
        data: [18, 31, 54, 156, 339, 818, 1201]
    }, {
        name: 'Oceania',
        data: [2, 2, 2, 6, 13, 30, 46]
    }]
});
</script>
