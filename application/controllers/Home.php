<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 
		$this->load->database();
		$this->load->model('Barang_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['tab1'] = true;
		$data['judul'] = "D-jenius Cafe";
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('template/footer');
	}
}


