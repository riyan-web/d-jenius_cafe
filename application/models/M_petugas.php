<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_model {
	
	private $table = "user";
	// $tgl    =date("Y-m-d");
	public function petugas_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{   
		$tgl    =date("Y-m-d");
		$sql = "SELECT (@row:=@row+1) AS nomora, id, nama_lengkap, username, password FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1 AND role_id = 2";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				nama_lengkap LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR username LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'nama_lengkap',
			2 => 'username',
			3 => 'password'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
    }

    public function nama_cek($nama_lengkap)
    {
        return $this->db->get_where($this->table, ["nama_lengkap" => $nama_lengkap])->num_rows();
    }
    public function username_cek($username)
    {
        return $this->db->get_where($this->table, ["username" => $username])->num_rows();
    }
    
    public function petugas_tambah($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->affected_rows();
    }
    
    public function petugas_by_id($id) {
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

    public function petugas_ubah($data, $id)
    {
        return $this->db->update($this->table, $data, array('id' => $id));
    }
    
    public function petugas_hapus($id) {
		$this->db->delete($this->table, array('id' => $id));
		return $this->db->affected_rows();
	}

	// tutup petugas / karyawan
	public function admin_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{   
		$tgl    =date("Y-m-d");
		$sql = "SELECT (@row:=@row+1) AS nomora, id, nama_lengkap, username, password FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1 AND role_id = 1";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				nama_lengkap LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR username LIKE '%".$this->db->escape_like_str($like_value)."%'
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'nama_lengkap',
			2 => 'username',
			3 => 'password'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
    }

}