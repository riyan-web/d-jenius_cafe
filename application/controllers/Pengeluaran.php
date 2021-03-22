<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); 
		cek_akses();
		$this->load->library('Template');
		$this->load->helper('myadmin');
		$this->load->model('M_pengeluaran', 'pengeluaran');
    }

    public function index()
    {
        $data['page'] 			= "pengeluaran";
		$data['judul'] 			= "Pengeluaran Harian";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "pengeluaran";

		$data['modal_pengeluaran'] = show_my_modal('_modal/mdl_pengeluaran', 'pengeluaran', $data);
		$this->template->views('V_pengeluaran', $data);
    }

    public function pengeluaran_list() {
		$requestData	= $_REQUEST;
		$fetch			= $this->pengeluaran->pengeluaran_data($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['nama_operasional'];
			$datanya[]	= "Rp " . number_format($row['jumlah'], 2, ",", ".");	
			$datanya[]	= $row['tipe'];
            $datanya[] = '
						  <a class="btn btn-info btn-xs" href="javascript:void(0)" title="Detail Pengeluaran"  role="button" onclick="detail_pengeluaran(' . "'" . $row['kd_operasional'] . "'" . ')"><i class="fa fa-list"> Detail</i></a> 
            <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Ubah Data" onclick="pengeluaran_ubah('."'".$row['kd_operasional']."'".')"><i class="fa fa-edit"> </i> Ubah</a>
				  <button class="btn btn-danger btn-xs konfirmasiHapus-pengeluaran" data-id="'.$row['kd_operasional'].'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>';

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


	public function pengeluaran_tambah() {
        $this->form_validation->set_rules('nama_operasional', 'Nama Pengeluaran', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
		$this->form_validation->set_rules('tipe', 'tipe', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			// $cekNama = $this->pengeluaran->nama_cek($this->input->post('nama_barang'));
			// if ($cekNama > 0) {
			// 	$out['status'] = 'form';
			// 	$out['msg'] = show_err_msg('Nama Pengeluaran Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
			// }else {
				$data = array(
					'nama_operasional' => $this->input->post('nama_operasional'),
					'deskripsi' => $this->input->post('deskripsi'),
                    'jumlah' => $this->input->post('jumlah'),
                    'tanggal' => date('Y-m-d'),
                    'tipe' => $this->input->post('tipe')
				);
				$result = $this->pengeluaran->pengeluaran_tambah($data);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Pengeluaran Berhasil ditambahkan', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_err_msg('Data Pengeluaran Gagal ditambahkan', '20px');
				}
			// }
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
    }
    
    public function pengeluaran_ubah($kd_operasional) {
		$data = $this->pengeluaran->pengeluaran_by_id($kd_operasional);
		echo json_encode($data);
	}

	public function pengeluaran_proses_ubah() {
		$this->form_validation->set_rules('nama_operasional', 'Nama Pengeluaran', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');
        $this->form_validation->set_rules('tipe', 'tipe', 'trim|required');
        
		// $cekNama = $this->kategori->nama_cek($this->input->post('nama_kategori'));
		// $kdKat = $this->input->post('kd_kategori');
		// $Namae = $this->kategori->kategori_by_id($kdKat);	
		
		// if($Namae->nama_kategori != $this->input->post('nama_kategori') && $cekNama > 0) {
		// 	$out['status'] = 'form';
		//  	$out['msg'] = show_err_msg('Nama Pengeluaran Sudah di <b>Pakai</b> atau <b>Terdaftar.</b>');
		// }else{
			if ($this->form_validation->run() == TRUE) {
				$kd_operasional = $this->input->post('kd_operasional');
				$data = array(
                        'nama_operasional' => $this->input->post('nama_operasional'),
                        'deskripsi' => $this->input->post('deskripsi'),
                        'jumlah' => $this->input->post('jumlah'),
                        'tanggal' => date('Y-m-d'),
                        'tipe' => $this->input->post('tipe')
					);
				$result = $this->pengeluaran->pengeluaran_ubah($data, $kd_operasional);

				if ($result > 0) {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Pengeluaran Berhasil diubah', '20px');
				} else {
					$out['status'] = '';
					$out['msg'] = show_succ_msg('Data Pengeluaran Gagal diubah', '20px');
				}
			} else {
				$out['status'] = 'form';
				$out['msg'] = show_err_msg(validation_errors());
			}
		// }
			
		echo json_encode($out);
	}

	public function pengeluaran_hapus() {
		$kd_pengeluaran = $_POST['kd_pengeluaran'];
		$result = $this->pengeluaran->pengeluaran_hapus($kd_pengeluaran);

		if ($result > 0) {
			echo show_succ_msg('Data pengeluaran Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data pengeluaran Gagal dihapus', '20px');
		}
	}

}
