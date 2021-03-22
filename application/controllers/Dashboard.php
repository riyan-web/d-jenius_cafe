<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_Controller
{
	public function __construct() {
        parent::__construct();
        cek_akses();
		$this->load->library('Template');
		$this->load->model('M_dashboard', 'dashboard');
			
	}
	public function index(){
		$data['page'] 			= "dashboard";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "dashboard";
		$data['barang'] = $this->dashboard->jumlah('tb_barang');
		$data['kategori'] = $this->dashboard->jumlah('tb_kategori');
		
		$this->template->views('V_dashboard', $data);
	}
}