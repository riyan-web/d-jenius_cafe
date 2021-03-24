<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_laporan extends CI_Model {
    private $table = "tb_operasional";
    private $table2 = "transaksi_jual";
	// $tgl    =date("Y-m-d");
	public function pengeluaranall_data($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$tgl    =date("Y-m-d");
		$sql = "SELECT (@row:=@row+1) AS nomora, kd_operasional, nama_operasional, deskripsi, jumlah, tanggal, tipe FROM ". $this->table .", (SELECT @row := 0) r WHERE 1=1";
		
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
    
    public function ambildata() {
        return $this->db->get($this->table)->result_array();
    }
    public function ambildatabytanggal($tgl_awal, $tgl_akhir) {
        $this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
        return $this->db->get($this->table)->result_array();
    }
    public function ambildataPen() {
        return $this->db->get($this->table2)->result_array();
    }
    public function ambildataPenbytanggal($tgl_awal, $tgl_akhir) {
        $this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
        return $this->db->get($this->table2)->result_array();
	}
	
	public function jumlah_pengeluaran() {
		return $this->db->query("SELECT sum(jumlah) as jumlah_semua from ".$this->table);
	}

	public function jumlah_penjualan() {
		return $this->db->query("SELECT sum(total_harga) as jumlah_semua from ".$this->table2);
	}

	public function jumlah_pengeluaranbytanggal($tgl_awal, $tgl_akhir) {
		return $this->db->query("SELECT sum(jumlah) as jumlah_semua from ".$this->table." WHERE tanggal >= '".$tgl_awal."' AND tanggal <= '".$tgl_akhir."'");
	}

	public function jumlah_penjualanbytanggal($tgl_awal, $tgl_akhir) {
		return $this->db->query("SELECT sum(total_harga) as jumlah_semua from ".$this->table2." WHERE tanggal >= '".$tgl_awal."' AND tanggal <= '".$tgl_akhir."'");
	}

}
