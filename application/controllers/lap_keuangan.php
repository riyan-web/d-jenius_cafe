<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_keuangan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Barang_model');
	}
	public function index()
	{
		$data['tab4'] = true;
		$data['judul'] = "Daftar Menu - D-jenius Cafe";
		// define('SITE_NAME', 'Menu Barang');
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('laporan/lap_keuangan', $data);
		$this->load->view('template/footer');
	}
}
