<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Laporan_model extends CI_Model {
	var $table = 'tb_keuangan';
	var $table_penjualan = 'detail_jual';
	var $table_trans = 'transaksi_jual';
	var $table_oper = 'tb_operasional';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function jumlah_terjual()
    {
    	return $this->db->query('SELECT tb_barang.nama_barang, sum(detail_jual.jumlah) as jumlah FROM detail_jual inner join tb_barang on tb_barang.kd_barang = detail_jual.kd_barang group by detail_jual.kd_barang')->result_array();
    }

	public function jumlah_modal()
	{
		$this->db->select_sum('modal');
		return $this->db->get($this->table)->row()->modal;
	}
	public function jumlah_pendapatan()
	{
		$this->db->select_sum('total_harga');
		return $this->db->get($this->table_trans)->row()->total_harga;
	}
	public function jumlah_operasional()
	{
		$this->db->select_sum('jumlah');
		return $this->db->get($this->table_oper)->row()->jumlah; 
	}
	public function modal()
	{
		return $this->db->query('select * from tb_keuangan where sisa_modal>0')->row();
	}

	public function tambah_modalBaru($data)
	{
		$this->db->insert($this->table, $data);
	}
	public function tambah_modalLagi($kd_keuangan, $data)
	{
		$this->db->query("UPDATE ".$this->table." SET sisa_modal = '".$data['sisa_modal']."' WHERE kd_keuangan = '".$kd_keuangan."'");
	}

	// operasional
	public function data_operasional($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "SELECT (@row:=@row+1) AS nomora, nama_operasional, tanggal, CONCAT('Rp. ', REPLACE(FORMAT(`jumlah`, 0),',','.') ) AS jumlah, tipe FROM tb_operasional, (SELECT @row := 0) r WHERE 1=1 ";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				nama_operasional LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR tanggal LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR tipe LIKE '%".$this->db->escape_like_str($like_value)."%'  
				OR CONCAT('Rp. ', REPLACE(FORMAT(`jumlah`, 0),',','.') ) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR tipe LIKE '%".$this->db->escape_like_str($like_value)."%' 
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'tanggal',
			2 => 'nama_operasional',
			3 => 'tipe',
			4 => 'jumlah'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
	public function data_laba($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "SELECT (@row:=@row+1) AS nomora, detail_jual.kd_barang, tb_barang.nama_barang, sum(detail_jual.jumlah) as jumlah, detail_jual.harga_satuan FROM detail_jual inner join tb_barang on tb_barang.kd_barang = detail_jual.kd_barang , (SELECT @row := 0) r WHERE 1=1 ";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				nama_barang LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR jumlah LIKE '%".$this->db->escape_like_str($like_value)."%'
				OR harga_satuan LIKE '%".$this->db->escape_like_str($like_value)."%'  
				OR CONCAT('Rp. ', REPLACE(FORMAT(`jumlah`, 0),',','.') ) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR jumlah LIKE '%".$this->db->escape_like_str($like_value)."%' 
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'nama_barang',
			2 => 'jumlah',
			3 => 'harga_satuan'
		);

		// $sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}
}