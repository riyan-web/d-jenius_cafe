<?php 

class Barang_model extends CI_model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function getAllKategori()
	{
		return $this->db->get('tb_kategori')->result_array();
	}
	public function getBarang($id_kategori)
	{
		return $this->db->get_where('tb_barang',  array('kd_kategori' =>$id_kategori))->result_array();
	}
}