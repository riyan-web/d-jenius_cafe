<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Barang_model');
	}
	public function index()
	{
		$data['tab2'] = true;
		$data['judul'] = "Daftar Menu - D-jenius Cafe";
		// define('SITE_NAME', 'Menu Barang');
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('barang/index', $data);
		$this->load->view('template/footer');
	}
}
