<?php

class Master_data extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('menu_model', 'menu');
	}

	public function index()
	{
		$data['tab2'] = true;
		$data['judul'] = "Data Menu - D-jenius Cafe";
		$data['kategori'] = $this->menu->get_kategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('masterdata/index', $data);
		$this->load->view('_js/js_menu');
		$this->load->view('_modal/modal_menu');
		$this->load->view('template/footer');
	}

	public function menu_list()
	{
		$list = $this->menu->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$n = 1;
		foreach ($list as $dataMenu) {
			$no++;
			$row = array();
			$row[] = $n++;
			$row[] = $dataMenu->nama_barang;
			$row[] = $dataMenu->harga;
			$row[] = $dataMenu->nama_kategori;
			if ($dataMenu->foto)
				$row[] = '<a href="' . base_url('upload/' . $dataMenu->foto) . '" target="_blank"><center><img src="' . base_url('upload/' . $dataMenu->foto) . '" class="img-responsive" style="height:160px; width:140px" /></center></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_menu(' . "'" . $dataMenu->kd_barang . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_menu(' . "'" . $dataMenu->kd_barang . "'" . ')"><i class="glyphicon glyphicon-trash"></i>hapus</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->menu->count_all(),
			"recordsFiltered" => $this->menu->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	public function menu_edit($kd_barang)
	{
		$data = $this->menu->get_by_id($kd_barang);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function menu_add()
	{
		$this->_validate();

		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'harga' => $this->input->post('harga'),
			'kd_kategori' => $this->input->post('kategori'),
			'deskripsi' => $this->input->post('deskripsi')
		);

		if (!empty($_FILES['photo']['name'])) {
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->menu->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function menu_update()
	{
		$this->_validate();
		$data = array(
			'nama_barang' => $this->input->post('nama_barang'),
			'harga' => $this->input->post('harga'),
			'kd_kategori' => $this->input->post('kategori'),
			'deskripsi' => $this->input->post('deskripsi')
		);

		if ($this->input->post('remove_photo')) // if remove photo checked
		{
			if (file_exists('upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/' . $this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if (!empty($_FILES['photo']['name'])) {
			$upload = $this->_do_upload();

			//delete file
			$menu = $this->menu->get_by_id($this->input->post('kd_barang'));
			if (file_exists('upload/' . $menu->foto) && $menu->foto)
				unlink('upload/' . $menu->foto);

			$data['photo'] = $upload;
		} else {
			$data['photo'] = $this->input->post('foto_lama');
		}

		$this->menu->update(array('kd_barang' => $this->input->post('kd_barang')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_menu($kd_barang)
	{
		//delete file
		$menu = $this->menu->get_by_id($kd_barang);
		if (file_exists('upload/' . $menu->foto) && $menu->foto)
			unlink('upload/' . $menu->foto);

		$this->menu->delete_by_id($kd_barang);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 4096; //set max size allowed in Kilobyte
		$config['max_width']            = 1000; // set max width image allowed
		$config['max_height']           = 1000; // set max height allowed
		$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) //upload and validate
		{
			$data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show menu error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('nama_barang') == '') {
			$data['inputerror'][] = 'nama_barang';
			$data['error_string'][] = 'Nama Barang wajib diisi lur';
			$data['status'] = FALSE;
		}

		if ($this->input->post('harga') == '') {
			$data['inputerror'][] = 'harga';
			$data['error_string'][] = 'Harga Jual wajib diisi lur';
			$data['status'] = FALSE;
		}

		if ($this->input->post('kategori') == '') {
			$data['inputerror'][] = 'kategori';
			$data['error_string'][] = 'Kategori wajib diisi lur';
			$data['status'] = FALSE;
		}

		if ($this->input->post('deskripsi') == '') {
			$data['inputerror'][] = 'deskrpisi';
			$data['error_string'][] = 'Deskrpsi Menu wajib diisi lur';
			$data['status'] = FALSE;
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
}
