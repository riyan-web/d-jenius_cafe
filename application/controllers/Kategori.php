<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

	public function __construct() 	{
		parent::__construct();
		cek_akses();
		$this->load->library('Template');
		$this->load->helper('myadmin');
		$this->load->model('M_kategori', 'kategori');
	}
	

	public function index(){ 
		$data['page'] 			= "kategori";
		$data['judul'] 			= "Kategori";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "kategori";
		$data['modal_kategori'] = show_my_modal('_modal/mdl_kategori', 'kategori', $data);
			
		$this->template->views('V_kategori', $data);
	}

	public function kategori_list() {
		$requestData	= $_REQUEST;
		$fetch			= $this->kategori->kategori_data($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['nama_kategori'];	
			$datanya[] = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="Ubah" onclick="kategori_ubah('."'".$row['kd_kategori']."'".')"><i class="fa fa-edit"> </i> Ubah</a>
				  <button class="btn btn-danger btn-xs konfirmasiHapus-kategori" data-id="'.$row['kd_kategori'].'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>';

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

	public function kategori_tambah() {
		$this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required');

		
		if ($this->form_validation->run() == TRUE) {
			$cekNama = $this->kategori->nama_cek($this->input->post('nama_kategori'));
			if ($cekNama > 0) {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Nama Kategori Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
			}else {
				$data = array(
					'nama_kategori' => $this->input->post('nama_kategori'),
				);
				$result = $this->kategori->kategori_tambah($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Kategori Berhasil ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data Kategori Gagal ditambahkan', '20px');
				}
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function kategori_ubah($kd_kategori) {
		$data = $this->kategori->kategori_by_id($kd_kategori);
		echo json_encode($data);
	}

	public function kategori_proses_ubah() {
		$this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required');
		
		$cekNama = $this->kategori->nama_cek($this->input->post('nama_kategori'));
		$kdKat = $this->input->post('kd_kategori');
		$Namae = $this->kategori->kategori_by_id($kdKat);	
		
		if($Namae->nama_kategori != $this->input->post('nama_kategori') && $cekNama > 0) {
			$out['status'] = 'form';
		 	$out['msg'] = show_err_msg('Nama Kategori Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
		}else{
			if ($this->form_validation->run() == TRUE) {
				$kd_kategori = $this->input->post('kd_kategori');
				$data = array(
						'nama_kategori' => $this->input->post('nama_kategori'),
					);
				$result = $this->kategori->kategori_ubah($data, $kd_kategori);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Kategori Berhasil diubah', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Kategori Gagal diubah', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
		}
			
		echo json_encode($out);
	}

	public function kategori_hapus() {
		$kd_kategori = $_POST['kd_ketegori'];
		$result = $this->kategori->kategori_hapus($kd_kategori);

		if ($result > 0) {
			echo show_succ_msg('Data kategori Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data kategori Gagal dihapus', '20px');
		}
	}
	// tutup kategori
	
}
