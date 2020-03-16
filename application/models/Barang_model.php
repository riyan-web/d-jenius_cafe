<?php 

class Barang_model extends CI_model {
	private $_table = "tb_barang";


	function __construct(){
		parent::__construct();
		$this->load->database();
	}


	public function getAllKategori()
	{
		return $this->db->get('tb_kategori')->result_array();
	}
	public function getAllBarang()
	{
		return $this->db->query('SELECT tb_kategori.nama_kategori, tb_barang.nama_barang, tb_barang.harga, tb_barang.deskripsi, tb_barang.kd_barang FROM tb_barang LEFT JOIN tb_kategori on tb_kategori.kd_kategori = tb_barang.kd_kategori')->result_array();
	}
	public function getBarang($id_kategori)
	{
		return $this->db->get_where($this->_table,  array('kd_kategori' =>$id_kategori))->result_array();
	}

	public function tambahDataMenu()
	{
		$data = [
				"nama_barang" => $this->input->post('nama_barang', true),
				"harga" => $this->input->post('harga', true),
				"kd_kategori" =>$this->input->post('kategori', true),
				"deskripsi" =>$this->input->post('deskripsi', true),
				"foto"=> $this->input->post('foto', true)
		];
		$this->db->insert($this->_table, $data);
	}

	public function hapusDataBarang($id)
	{
		$this->db->where('kd_barang', $id);
		$this->db->delete($this->_table);
	}

	public function cek_kode($kd_barang)
	{
		return $this->db
			->select('kd_barang')
			->where('kd_barang', $kd_barang)
			->limit(1)
			->get($this->_table);	
	}
}