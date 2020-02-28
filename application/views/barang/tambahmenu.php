 <div class="bradcam_area breadcam_bg_1 overlay mb-60">
    <h3>Tambah Menu Baru</h3>
</div>
<div class="container mb-30">
	
	<div class="row">
		<div class="col-lg-12 border border-dark">
			
			<div class="row"><div class="col-lg-12 text-center mb-30">
				<h4><b style="color: black ; font-weight: bold;">formulir resmi untuk menambahkan Menu baru</b></h4>
			</div></div>
			<div class="row">
				<div class="col-lg-6 offset-3">
					<?php if(validation_errors()) : ?>
						<div class="alert alert-danger" role="alert">
						  <?= validation_errors() ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<form action="<?= base_url('barang/tambahmenu') ?>" method="post">
				<div class="row">
					<div class=" form-group col-lg-7 col-md-6">
						<label for="nama_barang"><b style="color: black;">Nama Menu*</b></label>
		     			<input type="text" name="nama_barang" id="nama_barang" class="form-control" name="nama_barang" autofocus>
		     		</div>
		     		<div class=" form-group col-lg-4 col-md-6">
		     			<label for="">foto</label>
		     			<input type="file" class="form-control" name="foto" id="foto" placeholder="ini foto">
		     		</div>
		    	</div>
		    	<div class="row">
		    		<div class=" form-group col-lg-4 col-md-4">
						<label for="harga"><b style="color: black;">Harga Jual*</b></label>
		     			<input type="number" name="harga" id="harga" class="form-control" name="harga">
		     		</div>
		     		<div class=" form-group col-lg-3 col-md-4">
		     			<label for="kategori"><b style="color: black;">Kategori*</b></label>
		     			<select class="form-control" name="kategori" id="kategori">
		     				<?php foreach($kategori as $kate) : ?>
		     					<option value="<?= $kate['kd_kategori']  ?>"><?= $kate['nama_kategori'] ?></option>
		     				<?php endforeach; ?>
		     			</select>
		     		 		</div>
		    	</div>
		    	<div class="row">
		    		<div class="form-group col-lg-7">
		    			<label for="deskripsi"><b style="color: black;">Deskripsi*</b></label>
		    			<textarea class="form-control" name="deskripsi" id="deskripsi" ></textarea>
		    		 		</div>
		    		<div class="form-group col-lg-5 text-center">
						<label for=""> </label>
		    			<input class="btn btn-success btn-m" type="submit" name="simpan" value="Simpan" />
		    		</div>
		    	</div>
	    	</form>
	    	<div class="col-lg-2">
		    	<div class="card-footer small text-muted">
					* harus diisi
				</div>
			</div>
    	</div>
	</div>
</div>

<div class="container">
	<?php if ($this->session->flashdata()): ?>
		
	
	<div class="row mt-4">
		<div class=" offset-3 col-lg-6 col-md-6">
			<div class="alert alert-success" role="alert">
			  Data menu <strong>Berhasil</strong> <?= $this->session->flashdata(); ?>.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	</div>
	<?php endif ?>
	<div class=" offset-1 col-lg-10 text-center">
		<h3>Data Menu</h3><hr>
	</div>
	<div class="row">
		<div class="col-lg-10 offset-1">
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">No</th>
			      <th scope="col">Nama Menu</th>
			      <th scope="col">Harga</th>
			      <th scope="col">deskripsi</th>
			      <th scope="col">Kategori</th>
			      <th scope="col" class="text-center">Aksi</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php $no=1; ?>
			  	<?php foreach($barang as $menu) :?>
			    <tr>
			    	<td><?= $no++; ?></td>
			    	<td><?= $menu['nama_barang'] ?></td>
			    	<td><?= $menu['harga'] ?></td>
			    	<td><?= $menu['deskripsi'] ?></td>
			    	<td><?= $menu['nama_kategori'] ?></td>
			    	<td class="text-center">
			    		<a href="<?= base_url(); ?>barang/ubah/<?= $menu['kd_barang'] ?>" class="btn btn-warning btn-sm" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ubah</a>
                        <a href="<?= base_url(); ?>barang/hapus/<?= $menu['kd_barang'] ?>" class="btn btn-danger btn-sm"  onclick = "return confirm ('yakin akan menghapus data?');"> <i class="fa fa-trash-o" aria-hidden="true"></i> hapus</a>
			    	</td>
			    </tr>
				<?php endforeach; ?>
			  </tbody>
			</table>
		</div>
	</div>
</div>