<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_model {
	
	private $table = "transaksi_jual";
	// $tgl    =date("Y-m-d");
	public function penjualan_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{   
		$tgl    =date("Y-m-d");
		$sql = "SELECT (@row:=@row+1) AS nomora, kd_jual, tanggal, jumlah_total, total_harga, catatan FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1 AND tanggal = '$tgl'";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				kd_jual LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR tanggal LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR jumlah_total LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR total_harga LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'tanggal',
			2 => 'kd_jual',
			3 => 'jumlah_total',
			4 => 'total_harga'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	public function nama_cek($nama_pengeluaran)
    {
        return $this->db->get_where($this->table, ["nama_operasional" => $nama_pengeluaran])->num_rows();
	}

	public function pengeluaran_tambah($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows();
	}

	public function pengeluaran_by_id($kd_operasional) {
		$this->db->from($this->table);
		$this->db->where('kd_operasional',$kd_operasional);
		$query = $this->db->get();

		return $query->row();
	}

	public function pengeluaran_ubah($data, $kd_pengeluaran)
    {
        return $this->db->update($this->table, $data, array('kd_operasional' => $kd_pengeluaran));
	}

	public function pengeluaran_hapus($kd_pengeluaran) {
		$this->db->delete($this->table, array('kd_operasional' => $kd_pengeluaran));
		return $this->db->affected_rows();
	}

	public function jumlah_now() {
		return $this->db->query("SELECT sum(jumlah_total) as jumlah_semua, sum(total_harga) as total  from ".$this->table." where tanggal = '".date('Y-m-d')."'");
	}

}
