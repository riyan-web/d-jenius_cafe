<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['tab1'] = true;
		$data['judul'] = "D-jenius Cafe";
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('home/index');
		$this->load->view('template/footer');
	}
}


