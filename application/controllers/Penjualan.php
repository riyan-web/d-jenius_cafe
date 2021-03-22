<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); 
		cek_akses();
		$this->load->library('Template');
		$this->load->helper('myadmin');
		$this->load->model('M_penjualan', 'penjualan');
    }

    public function index()
    {
        $data['page'] 			= "penjualan";
		$data['judul'] 			= "Penjualan Harian";
		$data['deskripsi'] 		= "Panel";
		$data['pagae']	= "penjualan";

		// $data['modal_penjualan'] = show_my_modal('_modal/mdl_penjualan', 'penjualan', $data);
		$this->template->views('V_penjualan', $data);
	}
	
	public function penjualan_list() {
		$requestData	= $_REQUEST;
		$fetch			= $this->penjualan->penjualan_data($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= date("d-m-Y", strtotime($row['tanggal']));
			$datanya[]	= $row['kd_jual'];
			$datanya[]	= $row['jumlah_total'];
			$datanya[]	= "Rp " . number_format($row['total_harga'], 2, ",", ".");	
            $datanya[] = '
						  <a class="btn btn-info btn-xs" href="javascript:void(0)" title="Detail penjualan"  role="button" onclick="detail_penjualan(' . "'" . $row['kd_jual'] . "'" . ')"><i class="fa fa-list"> Detail</i></a> 
			';
			// <a class="btn btn-xs btn-success" href="javascript:void(0)" title="Ubah Data" onclick="penjualan_ubah('."'".$row['kd_jual']."'".')"><i class="fa fa-edit"> </i> Ubah</a>
			// 	  <button class="btn btn-danger btn-xs konfirmasiHapus-penjualan" data-id="'.$row['kd_jual'].'" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-trash"></i> Hapus</button>

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

}
