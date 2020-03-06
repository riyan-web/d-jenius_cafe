<?php 

class Keuangan_model extends CI_Model{
	function ambil_data(){
		return $this->db->get('tb_keuangan');
	}
}