<div class="bradcam_area breadcam_bg overlay">
        <h3>Tambah Data Operasional</h3>
</div>
<body>
	<center>
		<form action="<?php echo base_url(). 'operasional/tambah_aksi'; ?>" method="post">
			<table style="margin:10px auto;">
				<div class="col-md-6" >
					<div class="form-group">
						<br>
					  <div class="section_title"><h2>Form Tambah Operasional</h2></div>
						<tr>
							<td class="section_title"><span>Nama Operasional : </span></td>
							<td><input type="text" name="nama" class="form-control" placeholder='Masukkan Nama Operasional' required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Deskripsi : </span></td>
							<td><textarea name="deskripsi" class="form-control" placeholder='Tuliskan deskripsi' required></textarea></td>
						</tr>
						<tr>
							<td class="section_title"><span>Sebesar(Rp) : </span></td>
							<td><input type="text" name="jumlah" class="form-control" placeholder='Jumlah Biaya Operasional' required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Tanggal : </span></td>
							<td><input type="date" name="tanggal" class="form-control" placeholder='Masukkan tanggal' required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Tipe : </span></td>
							<td>
								<select name="tipe" class="form-control" required>
								   <option>operasional</option>
								   <option>inventaris</option>
                                </select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input class="button rounded-0 success-bg text-white w-100 btn_1 boxed-btn" type="submit" value="Tambah"></td>
						</tr>
					</div>
				</div>
	</center>

			
			
		</table>
	</form>	
	
</body>