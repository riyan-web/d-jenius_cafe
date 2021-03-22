<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 
		cek_akses();
		$this->load->library('Template');
		$this->load->helper('myadmin');
		$this->load->model('M_menu', 'menu');
	}
 
	public function index() {
		$data['page'] 			= "barang";
		$data['judul'] 			= "Beranda";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "barang";

		$this->load->model('M_kategori', 'kategori');
		$data['data_kategori'] = $this->kategori->kategori_all();

		$data['modal_menu'] = show_my_modal('_modal/mdl_menu', 'menu', $data);
		$this->template->views('V_menu', $data);
	}

	public function menu_list() {
		$requestData	= $_REQUEST;
		$fetch			= $this->menu->menu_data($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['nama_barang'];
			$datanya[]	= "Rp " . number_format($row['harga'], 2, ",", ".");
			$datanya[]	= $row['nama_kategori'];
			$datanya[] = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="Ubah" onclick="menu_ubah('."'".$row['kd_barang']."'".')"><i class="fa fa-edit"> </i> Ubah</a>
				  <button class="btn btn-danger btn-xs konfirmasiHapus-barang" data-id="'.$row['kd_barang'].'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
				  <a class="btn btn-xs btn-info" href="javascript:void(0)" title="Ubah" onclick="grafik('."'".$row['kd_barang']."'".')"><i class="fa fa-bar-chart"> </i> Grafik</a> 
				  ';

			$data[] = $datanya;
		}

		$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data
			);

		echo json_encode($json_data);
	}


	public function menu_tambah() {
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$cekNama = $this->menu->nama_cek($this->input->post('nama_barang'));
			if ($cekNama > 0) {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Nama Menu Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
			}else {
				$data = array(
					'nama_barang' => $this->input->post('nama_barang'),
					'harga' => $this->input->post('harga'),
					'kd_kategori' => $this->input->post('kategori')
				);
				$result = $this->menu->menu_tambah($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Menu Berhasil ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data KateMenugori Gagal ditambahkan', '20px');
				}
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}
	
	public function menu_ubah($kd_menu) {
		$data = $this->menu->menu_by_id($kd_menu);
		echo json_encode($data);
	}

	public function menu_proses_ubah() {
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
		$cekNama = $this->menu->nama_cek($this->input->post('nama_barang'));
		$kdMen = $this->input->post('kd_barang');
		$Namae = $this->menu->menu_by_id($kdMen);

		if($Namae->nama_barang != $this->input->post('nama_barang') && $cekNama > 0 ){
			$out['status'] = 'form';
			$out['msg'] = show_err_msg('Nama Menu Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
		} else  {
			if ($this->form_validation->run() == TRUE) {
				$kd_barang = $this->input->post('kd_barang');
				$data = array(
						'nama_barang' => $this->input->post('nama_barang'),
						'harga' => $this->input->post('harga'),
						'kd_kategori' => $this->input->post('kategori')
					);
				$result = $this->menu->menu_ubah($data, $kd_barang);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Barang Berhasil diubah', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Barang Gagal diubah', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
		}
		echo json_encode($out);
	}

	public function menu_hapus() {
		$kd_barang = $_POST['kd_barang'];
		$result = $this->menu->menu_hapus($kd_barang);

		if ($result > 0) {
			echo show_succ_msg('Data menu Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data menu Gagal dihapus', '20px');
		}
	}
	
}
