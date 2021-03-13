<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
    }

    public function index()
    {
        $data['tab4'] = true;
        $data['judul'] = "Data Pengeluaran - Cafe HM";
        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('pengeluaran/index');
        $this->load->view('template/footer');
    }
}
