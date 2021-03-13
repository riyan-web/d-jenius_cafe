<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 
		cek_akses();
		$this->load->database();
		$this->load->model('Barang_model');
		$this->load->model('Keuangan_model');
		$this->load->library('form_validation');
	}
	public function tambahMenu()
	{
		$data['tab2'] = true;
		$data['judul'] = "Tambah Menu Baru - D-jenius Cafe";
		$data['kategori'] = $this->Barang_model->getAllKategori();
		$data['barang'] = $this->Barang_model->getAllBarang();
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga Jual', 'required|numeric');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('barang/tambahmenu', $data);
			$this->load->view('template/footer');
		}else{
			$this->Barang_model->tambahDataMenu();
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('Barang/tambahmenu');
		}
		
	}
	public function hapus($id)
	{
		$this->Barang_model->hapusDataBarang($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('Barang/tambahmenu');
	}

	
}
