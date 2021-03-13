<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	var $table = 'tb_barang';
	var $column_order = array('nama_barang','harga','nama_kategori',null); //set column field database for datatable orderable
	var $column_search = array('nama_barang','harga','nama_kategori'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	 var $order = array('kd_barang' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->select('tb_kategori.nama_kategori, tb_barang.nama_barang, tb_barang.harga, tb_barang.deskripsi, tb_barang.kd_barang, tb_barang.foto');
		$this->db->from($this->table);
		$this->db->join('tb_kategori','tb_kategori.kd_kategori=tb_barang.kd_kategori');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($kd_barang)
	{
		$this->db->from($this->table);
		$this->db->where('kd_barang',$kd_barang);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
			$sql = "INSERT INTO tb_barang (kd_barang, nama_barang, harga, kd_kategori, deskripsi, foto) VALUES ('', '" .$data['nama_barang']. "', '" .$data['harga']. "', '" .$data['kd_kategori']."', '" .$data['deskripsi']. "', '" .$data['photo']. "')";
		return $this->db->query($sql);
		// $this->db->insert($this->table, $data);
		// return $this->db->insert_id();
	}

	public function update($kd_barang, $data)
	{	
		$sql = "UPDATE tb_barang SET nama_barang = '". $data['nama_barang'] ."', harga = '". $data['harga'] ."', kd_kategori = '" .$data['kd_kategori']. "', deskripsi = '" .$data['deskripsi']. "', foto = '" .$data['photo']. "' WHERE kd_barang= '" .$kd_barang['kd_barang']. "'";
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function delete_by_id($kd_barang)
	{
		$this->db->where('kd_barang', $kd_barang);
		$this->db->delete($this->table);
	}

	public function get_kategori()
	{
		return $data = $this->db->query('SELECT * FROM tb_kategori')->result_array();
	}

}
