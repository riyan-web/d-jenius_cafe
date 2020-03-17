<div class="bradcam_area breadcam_bg overlay">
        <h3>Tambah Data Operasionals</h3>
</div>
<body>
	<center>
		<h1>Membuat CRUD dengan CodeIgniter | MalasNgoding.com</h1>
		<h3>Tambah data baru</h3>
	</center>
	<form action="<?php echo base_url(). 'operasional/tambah_aksi'; ?>" method="post">
		<table style="margin:20px auto;">
			<tr>
				<td>Nama Operasional</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><input type="text" name="deskripsi"></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" name="jumlah"></td>
            </tr>
            <tr>
				<td>Tanggal</td>
				<td><input type="date" name="tanggal"></td>
            </tr>
            <tr>
				<td>Tipe</td>
				<td><input type="text" name="tipe"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Tambah"></td>
			</tr>
		</table>
	</form>	
</body>