<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_menu extends CI_model {
	// buka kategori
	private $table = "tb_barang";
	public function menu_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "SELECT (@row:=@row+1) AS nomora, kd_barang, nama_barang, harga, nama_kategori FROM ". $this->table ." join tb_kategori on tb_kategori.kd_kategori = tb_barang.kd_kategori, (SELECT @row := 0) r WHERE 1=1 ";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				kd_barang LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR nama_barang LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR harga LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR nama_kategori LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'nama_barang',
			2 => 'harga',
			3 => 'nama_kategori'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}	

	public function nama_cek($nama_barang)
    {
        return $this->db->get_where($this->table, ["nama_barang" => $nama_barang])->num_rows();
	}

	public function menu_tambah($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows();
	}

	public function menu_by_id($kd_barang) {
		$this->db->from($this->table);
		$this->db->where('kd_barang',$kd_barang);
		$query = $this->db->get();

		return $query->row();
	}

	public function menu_ubah($data, $kd_barang)
    {
        return $this->db->update($this->table, $data, array('kd_barang' => $kd_barang));
	}

	public function menu_hapus($kd_barang) {
		$this->db->delete($this->table, array('kd_barang' => $kd_barang));
		return $this->db->affected_rows();
	}
}