<input type="hidden" id="kd_jual" value="<?= html_escape($master->kd_jual); ?>">
<input type="hidden" id="tanggal" value="<?= $master->tanggal; ?>">
<input type="hidden" id="UangCash" value="<?= $master->bayar; ?>">
<input type="hidden" id="catatan" value="<?= html_escape($master->catatan); ?>">
<input type="hidden" id="TotalBayarHidden" value="<?= $master->total_harga; ?>">

<table id="my-grid" class="table tabel-transaksi" style='margin-bottom: 0px; margin-top: 10px;'>
	<thead>
		<tr>
			<th>#</th>
			<th>Kode Menu</th>
			<th>Nama Menu</th>
			<th>Harga Satuan</th>
			<th>Jumlah Beli</th>
			<th>Sub Total</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$no 			= 1;
	foreach($detail->result() as $d)
	{
		echo "
			<tr>
				<td>".$no."</td>
				<td>".$d->kd_barang." <input type='hidden' name='kd_barang[]' value='".html_escape($d->kd_barang)."'></td>
				<td>".$d->nama_barang."</td>
				<td>".$d->harga_satuan." <input type='hidden' name='harga_satuan[]' value='".$d->harga_satuan_asli."'></td>
				<td>".$d->jumlah." <input type='hidden' name='jumlah_beli[]' value='".$d->jumlah."'></td>
				<td>".$d->sub_total." <input type='hidden' name='sub_total[]' value='".$d->sub_total_asli."'></td>
			</tr>
		";

		$no++;
	}

	echo "
		<tr style='background:#deeffc;'>
			<td colspan='5' style='text-align:right;'><b>Grand Total</b></td>
			<td><b>Rp. ".str_replace(',', '.', number_format($master->total_harga))."</b></td>
		</tr>
		<tr>
			<td colspan='5' style='text-align:right; border:0px;'>Bayar</td>
			<td style='border:0px;'>Rp. ".str_replace(',', '.', number_format($master->bayar))."</td>
		</tr>
		<tr>
			<td colspan='5' style='text-align:right; border:0px;'>Kembali</td>
			<td style='border:0px;'>Rp. ".str_replace(',', '.', number_format(($master->bayar - $master->total_harga)))."</td>
		</tr>
	";
	?>
	</tbody>
</table>

<script>
$(document).ready(function(){
	var Tombol = "<button type='button' class='btn btn-primary' id='Cetaks'><i class='fa fa-print'></i> Cetak</button>";
	Tombol += "<button type='button' class='btn btn-default' data-dismiss='modal'>Tutup</button>";
	$('#ModalFooter').html(Tombol);

	$('button#Cetaks').click(function(){
		var FormData = "kd_transaksi="+encodeURI($('#kd_jual').val());
		FormData += "&tanggal="+encodeURI($('#tanggal').val());
		FormData += "&" + $('.tabel-transaksi tbody input').serialize();
		FormData += "&cash="+$('#UangCash').val();
		FormData += "&catatan="+encodeURI($('#catatan').val());
		FormData += "&grand_total="+$('#TotalBayarHidden').val();

		window.open("<?= base_url('transaksi/transaksi_cetak/?'); ?>" + FormData,'_blank');
	});
});
</script>