<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
    }

    public function index()
    {
        $data['tab3'] = true;
        $data['judul'] = "Data Penjualan - Cafe HM";
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('penjualan/index');
        $this->load->view('template/footer');
    }
}
