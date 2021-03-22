 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Laporan extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();
			cek_akses();
			$this->load->library('Template');
			$this->load->helper('myadmin');
			$this->load->model('M_laporan', 'laporan');
		}

		public function penjualan()
		{
			$data['page'] 			= "laporan";
			$data['judul'] 			= "Penjualan Seluruhnya";
			$data['deskripsi'] 		= "Panel";
			$data['pagae']	= "lappenjualan";
			if (empty($_POST['tgl_awal'])) {
				$data['data_penjualan'] = $this->laporan->ambildataPen();
			}else{
				$tgl_awal = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
				$tgl_akhir = date("Y-m-d", strtotime($this->input->post('tgl_akhir')));
				$data['data_penjualan'] = $this->laporan->ambildataPenbytanggal($tgl_awal, $tgl_akhir);
			}
			$this->template->views('V_lappenjualan', $data);
		}

		// buka lap pengeluaran
		public function pengeluaran()
		{
			$data['page'] 			= "laporan";
			$data['judul'] 			= "Pengeluaran Seluruhnya";
			$data['deskripsi'] 		= "Panel";
			$data['pagae']	= "lappengeluaran";
			if (empty($_POST['tgl_awal'])) {
				$data['data_pengeluaran'] = $this->laporan->ambildata();
			}else{
				$tgl_awal = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
				$tgl_akhir = date("Y-m-d", strtotime($this->input->post('tgl_akhir')));
				$data['data_pengeluaran'] = $this->laporan->ambildatabytanggal($tgl_awal, $tgl_akhir);
			}
			$this->template->views('V_lappengeluaran', $data);
		}
		//tutup pengeluaran

		public function labarugi()
		{
			$data['page'] 			= "laporan";
			$data['judul'] 			= "Laba Rugi Seluruhnya";
			$data['deskripsi'] 		= "Panel";
			$data['pagae']	= "laplabarugi";

			$data['pengeluaran'] = $this->laporan->jumlah_pengeluaran()->row();
			$data['penjualan'] =  $this->laporan->jumlah_penjualan()->row();

			$this->template->views('V_laplabarugi', $data);
		}		
	}
