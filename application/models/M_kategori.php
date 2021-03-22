<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	// buka kategori
	private $table = "tb_kategori";
	public function kategori_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "SELECT (@row:=@row+1) AS nomora, kd_kategori, nama_kategori FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1 ";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				kd_kategori LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR nama_kategori LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'kd_kategori',
			2 => 'nama_kategori',
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	public function kategori_tambah($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows();
	}
	public function kategori_by_id($kd_kategori) {
		$this->db->from($this->table);
		$this->db->where('kd_kategori',$kd_kategori);
		$query = $this->db->get();

		return $query->row();
	}

	public function nama_cek($nama_kategori)
    {
        return $this->db->get_where($this->table, ["nama_kategori" => $nama_kategori])->num_rows();
	}
	
	public function kategori_ubah($data, $kd_kategori)
    {
        return $this->db->update($this->table, $data, array('kd_kategori' => $kd_kategori));
	}

	public function kategori_hapus($kd_kategori) {
		$this->db->delete($this->table, array('kd_kategori' => $kd_kategori));
		return $this->db->affected_rows();
	}

	public function kategori_all() {
		return $this->db->get($this->table)->result_array();
	}
}