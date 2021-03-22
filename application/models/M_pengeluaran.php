<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengeluaran extends CI_model {
	
	private $table = "tb_operasional";
	// $tgl    =date("Y-m-d");
	public function pengeluaran_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$tgl    =date("Y-m-d");
		$sql = "SELECT (@row:=@row+1) AS nomora, kd_operasional, nama_operasional, deskripsi, jumlah, tanggal, tipe FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1 AND tanggal = '$tgl'";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				nama_operasional LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR deskripsi LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR jumlah LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR tipe LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'nama_operasional',
			2 => 'deskripsi',
			3 => 'jumlah',
			4 => 'tipe'
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
}
