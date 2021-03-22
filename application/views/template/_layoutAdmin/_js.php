<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url(); ?>public/backend/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>public/backend/plugins/chartjs/Chart.js"></script>
<script>
   $(document).ready(function () {
                $('#tgl_awal').datepicker({
                 //merubah format tanggal datepicker ke dd-mm-yyyy
                    format: "dd-mm-yyyy",
                    //aktifkan kode dibawah untuk melihat perbedaanya, disable baris perintah diatasa
                    //format: "dd-mm-yyyy",
                    autoclose: true
                });
                $('#tgl_akhir').datepicker({
                 //merubah format tanggal datepicker ke dd-mm-yyyy
                    format: "dd-mm-yyyy",
                    //aktifkan kode dibawah untuk melihat perbedaanya, disable baris perintah diatasa
                    //format: "dd-mm-yyyy",
                    autoclose: true
                });
            });
</script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>public/backend/dist/js/app.min.js"></script>
<script>
	
	function harusHuruf(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
	    if ((charCode < 65 || charCode > 90)&&(charCode < 97 || charCode > 122)&&charCode>32)
	    return false;
	    return true;
	}
	function harusAngka(evt)
    {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;
      return true;
    }
    
</script>

<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: 'jumlah terjual',
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