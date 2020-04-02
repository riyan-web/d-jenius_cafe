<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_penjualan extends CI_Model {
	var $table = 'detail_jual';
	var $table_trans = 'transaksi_jual';
	var $table_oper = 'tb_operasional';
	function __construct()
	{
		parent::__construct();
		$this->load->database();
    }

    public function jumlah_terjual()
    {
        $this->db->select_sum('jumlah')->group_by()->kd_barang;
		return $this->db->get($this->table);
    }

}


?>