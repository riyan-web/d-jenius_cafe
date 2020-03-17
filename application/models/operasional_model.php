<?php 

class Operasional_model extends CI_model {

	public function getOperasional()
	{
		return $this->db->get('tb_operasional');
	}
	
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
    
}
