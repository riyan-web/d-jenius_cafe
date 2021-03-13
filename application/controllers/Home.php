<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_akses();
		$this->load->model('Barang_model');
	}

	public function index()
	{
		$data['tab1'] = true;
		$data['judul'] = "Kedai Happy Memory";
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/index', $data);
		$this->load->view('template/footer');
	}

	public function admin()
	{
		$data['tab1'] = true;
		$data['judul'] = "Halaman Admin";
		$data['user'] = $this->db->get_where('user', ['username' =>
		$this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/admin', $data);
		$this->load->view('template/footer');
	}
}
