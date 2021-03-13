<div class="bradcam_area breadcam_bg overlay">
        <h3>Edit Data Operasional</h3>
</div>
<body>
	<center>
    <?php foreach($tb_operasional as $oper){ ?>
		<form action="<?php echo base_url(). 'operasional/update'; ?>" method="post">
			<table style="margin:10px auto;">
				<div class="col-md-6" >
					<div class="form-group">
						<br>
                      <div class="section_title"><h2>Form Edit Operasional</h2></div>
                        <tr>
                            <input type="hidden" name="kd_operasional" value="<?php echo $oper->kd_operasional ?>">
                        </tr>
						<tr>
							<td class="section_title"><span>Nama Operasional : </span></td>
							<td><input type="text" name="nama" class="form-control" value="<?php echo $oper->nama_operasional ?>" required ></td>
						</tr>
						<tr>
							<td class="section_title"><span>Deskripsi : </span></td>
							<td><input type="text" name="deskripsi" class="form-control" value="<?php echo $oper->deskripsi ?>"  required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Sebesar(Rp) : </span></td>
							<td><input type="text" name="jumlah" class="form-control" value="<?php echo $oper->jumlah ?>" required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Tanggal : </span></td>
							<td><input type="date" name="tanggal" class="form-control" value="<?php echo $oper->tanggal?>" required></td>
						</tr>
						<tr>
							<td class="section_title"><span>Tipe : </span></td>
							<td>
								<select name="tipe" class="form-control" required>
								<option value="<?php echo $oper->tipe ?>"><?php echo "---".$oper->tipe."---" ?></option>
								   <option>operasional</option> 
								   <option>inventaris</option>
                                </select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input class="button rounded-0 success-bg text-white w-100 btn_1 boxed-btn" type="submit" value="Simpan"></td>
						</tr>
					</div>
				</div>
	</center>

			
			
		</table>
    </form>	
    <?php } ?>
	
</body>