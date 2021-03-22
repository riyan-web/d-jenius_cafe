<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function jumlah($table) {
		$sql="select * from ".$table."";
		return $this->db->query($sql)->num_rows();
	}
}