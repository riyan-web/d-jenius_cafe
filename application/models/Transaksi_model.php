<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {
	var $table = 'transaksi_jual';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	
	public function max_kode(){
		$this->db->select_max('kd_jual');
		$query = $this->db->get($this->table)->row();
		$noUrut = (int) substr($query->kd_jual, 13, 2);
		$char = date('ymdis');
		$noUrut++;
		if ($noUrut<10) {
		    
		    $baru = "TJ-".$char . sprintf("%002s", $noUrut);
		    
		}else {
		    $baru = "TJ-".$char . sprintf("%001s", $noUrut);
		}
		return $baru;
	}

	public function data_penjualan($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "SELECT (@row:=@row+1) AS nomora, tanggal, kd_jual, CONCAT('Rp. ', REPLACE(FORMAT(`total_harga`, 0),',','.') ) AS total_harga, catatan, bayar FROM transaksi_jual, (SELECT @row := 0) r WHERE 1=1 ";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();

		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				kd_jual LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR tanggal LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR CONCAT('Rp. ', REPLACE(FORMAT(`total_harga`, 0),',','.') ) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR catatan LIKE '%".$this->db->escape_like_str($like_value)."%' 
			";
			$sql .= " ) ";
		}

		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomora',
			1 => 'tanggal',
			2 => 'kd_jual',
			3 => 'total_harga',
			4 => 'catatan'
		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomora ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function cari_kode($keyword, $registered)
	{
		$not_in = '';

		$koma = explode(',', $registered);
		if(count($koma) > 1)
		{
			$not_in .= " AND `kd_barang` NOT IN (";
			foreach($koma as $k)
			{
				$not_in .= " '".$k."', ";
			}
			$not_in = rtrim(trim($not_in), ',');
			$not_in = $not_in.")";
		}
		if(count($koma) == 1)
		{
			$not_in .= " AND `kd_barang` != '".$registered."' ";
		}

		$sql = "
			SELECT 
				`kd_barang`, `nama_barang`, `harga` 
			FROM 
				`tb_barang` 
			WHERE 
				`kd_barang` LIKE '%".$this->db->escape_like_str($keyword)."%' 
					OR `nama_barang` LIKE '%".$this->db->escape_like_str($keyword)."%' 
				".$not_in." 
		";

		return $this->db->query($sql);
	}

	public function tambah_transaksi($kd_transaksi, $tanggal, $jumlah_total, $total_harga, $bayar, $catatan, $nomeja)
	{
		$dt = array(
			'kd_jual' => $kd_transaksi,
			'tanggal' => $tanggal,
			'jumlah_total' => $jumlah_total,
			'total_harga' => $total_harga,
			'bayar' => $bayar,
			'catatan' => $catatan,
			'nomeja' => $nomeja,
		);

		return $this->db->insert($this->table, $dt);
	}

	public function tambah_detail($kd_transaksi, $kd_barang, $jumlah_beli, $harga_satuan, $sub_total)
	{
		$dt = array(
			'kd_jual' => $kd_transaksi,
			'kd_barang' => $kd_barang,
			'jumlah' => $jumlah_beli,
			'harga_satuan' => $harga_satuan,
			'sub_total' => $sub_total,
		);

		return $this->db->insert('detail_jual', $dt);
	}

	function ambil_detail($kd_jual) //ke detail
	{
		$sql = "SELECT 
				b.`kd_barang`,  
				b.`nama_barang`, 
				CONCAT('Rp. ', REPLACE(FORMAT(a.`harga_satuan`, 0),',','.') ) AS harga_satuan, 
				a.`harga_satuan` AS harga_satuan_asli, 
				a.`jumlah`,
				CONCAT('Rp. ', REPLACE(FORMAT(a.`sub_total`, 0),',','.') ) AS sub_total,
				a.`sub_total` AS sub_total_asli  
			FROM 
				`detail_jual` a 
				LEFT JOIN `tb_barang` b ON a.`kd_barang` = b.`kd_barang` 
			WHERE 
				a.`kd_jual` = '".$kd_jual."' 
			ORDER BY 
				a.`kd_jual` ASC ";
		return $this->db->query($sql);
	}

	function ambil_baris($kd_jual) //ke transaksi jual
	{
		$sql = "SELECT * FROM transaksi_jual WHERE kd_jual = '".$kd_jual."' LIMIT 1 ";
		return $this->db->query($sql);
	}

}