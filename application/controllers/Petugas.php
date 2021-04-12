<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {
	public function __construct()
	{
		parent::__construct(); 
		cek_akses();
		$this->load->library('Template');
		$this->load->helper('myadmin');
		$this->load->model('M_petugas', 'petugas');
	}
 
	public function index() {
		$data['page'] 			= "petugas";
		$data['judul'] 			= "Karyawan";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "petugas";


		$data['modal_petugas'] = show_my_modal('_modal/mdl_petugas', 'petugas', $data);
		$this->template->views('V_petugas', $data);
    }
	
	public function petugas_list() {
		$requestData	= $_REQUEST;
		$fetch			= $this->petugas->petugas_data($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['nama_lengkap'];
			$datanya[]	= $row['username'];
			$datanya[]	= $row['password'];
			$datanya[] = '<a class="btn btn-xs btn-success" href="javascript:void(0)" title="Ubah" onclick="petugas_ubah('."'".$row['id']."'".')"><i class="fa fa-edit"> </i> Ubah</a>
				  <button class="btn btn-danger btn-xs konfirmasiHapus-petugas" data-id="'.$row['id'].'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
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

	public function petugas_tambah() {
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		if ($this->form_validation->run() == TRUE) {
			$cekNama = $this->petugas->nama_cek($this->input->post('nama_lengkap'));
			$cekUsername = $this->petugas->username_cek($this->input->post('username'));
			if ($cekNama > 0) {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Nama Lengkap Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
			} else if ($cekUsername > 0) {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg('Username Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
			}else {
				$data = array(
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);

				if ($this->session->userdata['role_id'] == 1) {
					$data['role_id'] = 2;
				}
				if ($this->session->userdata['role_id'] == 3) {
					$data['role_id'] = 1;
				}

				$result = $this->petugas->petugas_tambah($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data User Berhasil ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data User Gagal ditambahkan', '20px');
				}
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function petugas_ubah($kd_petugas) {
		$data = $this->petugas->petugas_by_id($kd_petugas);
		echo json_encode($data);
	}

	public function petugas_proses_ubah() {
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		
		$cekNama = $this->petugas->nama_cek($this->input->post('nama_lengkap'));
		$cekUsername = $this->petugas->username_cek($this->input->post('username'));
		$id = $this->input->post('id');
		$Namae = $this->petugas->petugas_by_id($id);	
		
		if($Namae->nama_lengkap != $this->input->post('nama_lengkap') && $cekNama > 0) {
			$out['status'] = 'form';
		 	$out['msg'] = show_err_msg('Nama Kategori Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
		}else if($Namae->username != $this->input->post('username') && $cekUsername > 0) {
			$out['status'] = 'form';
		 	$out['msg'] = show_err_msg('Username Sudah di <b>Pakai</b> atau <b>Terdaftar Oleh user lain.</b>');
		}else{
			if ($this->form_validation->run() == TRUE) {
				$idPe = $this->input->post('id');
				$data = array(
						'nama_lengkap' => $this->input->post('nama_lengkap'),
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password')
					);
				$result = $this->petugas->petugas_ubah($data, $idPe);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data user Karyawan Berhasil diubah', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data user Karyawan Gagal diubah', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
		}
			
		echo json_encode($out);
	}

	public function petugas_hapus() {
		$id = $_POST['id'];
		$result = $this->petugas->petugas_hapus($id);

		if ($result > 0) {
			echo show_succ_msg('Data user Karyawan Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data user Karyawan Gagal dihapus', '20px');
		}
	}

}