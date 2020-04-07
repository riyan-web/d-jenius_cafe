<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model','kategori');
	}

	public function index(){ 
		$data['tab2'] = true;
		$data['judul'] = "Data Kategori - D`jenius Cafe";
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('masterdata/kategori');
		$this->load->view('_js/js_kategori');
		$this->load->view('_modal/modal_kategori');
		$this->load->view('template/footer');
	}
	public function kategori_list()
	{
		$list = $this->kategori->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$n=1;
		foreach ($list as $dataKategori) {
			$no++;
			$row = array();
			$row[] = $n++;
			$row[] = $dataKategori->nama_kategori;
		
			//add html for action
			$row[] = '<a class="btn btn-xs btn-warning" href="javascript:void(0)" title="Edit" onclick="edit_kategori('."'".$dataKategori->kd_kategori."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_kategori('."'".$dataKategori->kd_kategori."'".')"><i class="glyphicon glyphicon-trash"></i> hapus</a>
				  <a class="btn btn-xs btn-info" href="javascript:void(0)" title="Detail" onclick="detail_kategori('."'".$dataKategori->kd_kategori."'".')"><i class="glyphicon glyphicon-info-sign"></i> Detail</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kategori->count_all(),
						"recordsFiltered" => $this->kategori->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function kategori_edit($kd_kategori)
	{
		$data = $this->kategori->get_by_id($kd_kategori);
		echo json_encode($data);
	}

	public function kategori_add()
	{
		$this->_validate();
		
		$data = array(
				'nama_kategori' => $this->input->post('nama_kategori')
			);

		$insert = $this->kategori->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function kategori_update()
	{
		$this->_validate();
		$data = array(
				'nama_kategori' => $this->input->post('nama_kategori')
			);

		$this->kategori->update(array('kd_kategori' => $this->input->post('kd_kategori')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function kategori_delete($kd_kategori)
	{
		//delete file
		$this->kategori->delete_by_id($kd_kategori);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_kategori') == '')
		{
			$data['inputerror'][] = 'nama_kategori';
			$data['error_string'][] = 'Nama Kategori wajib diisi lur';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
