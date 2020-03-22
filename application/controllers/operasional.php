<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operasional extends CI_Controller {
    public function __construct()
	{
		parent::__construct(); 
		$this->load->database();
        $this->load->model('operasional_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$data['tab4'] = true;
        $data['judul'] = "Data Operasional";
        $data['tb_operasional'] = $this->operasional_model->getOperasional()->result();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('operasional/index',$data);
		$this->load->view('template/footer');
    }
    
    public function tambah_data()
    {
        $data['tab4'] = true;
        $data['judul'] ="Tambah Data Operasional";
        $this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('operasional/tambah_data',$data);
		$this->load->view('template/footer');
    }

    function tambah_aksi(){
		$nama = $this->input->post('nama');
		$deskripsi = $this->input->post('deskripsi');
        $jumlah = $this->input->post('jumlah');
        $tanggal = $this->input->post('tanggal');
        $tipe = $this->input->post('tipe');

		$data = array(
            'kd_operasional' => '',
			'nama_operasional' => $nama,
			'deskripsi' => $deskripsi,
            'jumlah' => $jumlah,
            'tanggal' => $tanggal,
            'tipe' => $tipe
			);
		$this->operasional_model->input_data($data,'tb_operasional');
		redirect('operasional/index');
	}
}


