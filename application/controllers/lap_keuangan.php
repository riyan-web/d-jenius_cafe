<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_keuangan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
		// $this->load->model('keuangan_model');
	}
	public function index() 
	{	$dat['nama'] ="malasngoding";
		$data['tb_keuangan'] = $this->keuangan_model->ambil_data()->result();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('laporan/lap_keuangan', $data);
		$this->load->view('template/footer');
	}
}
