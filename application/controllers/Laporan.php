 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_model','laporan');
	} 

	public function laporan_keuangan()
	{
		$data['tab3']= true;
		$data['judul'] = "Halaman Laporan - D`coba";
		$data['modalwal'] = $this->laporan->modal();
		$data['modalah'] = $this->laporan->jumlah_modal();
		$data['pendapatan'] = $this->laporan->jumlah_pendapatan();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('laporan/keuangan', $data);
		$this->load->view('_js/js_laporan');
		$this->load->view('template/footer');
	}

	public function laporan_operasional()
	{
		$data['tab3']= true;
		$data['judul'] = "Halaman Laporan - D`coba";
		$data['operasional'] = $this->laporan->jumlah_operasional();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('laporan/operasional', $data);
		$this->load->view('_js/js_laporan');
		$this->load->view('template/footer');
	}

	public function laporan_labarugi()
	{
		$data['tab3']= true;
		$data['judul'] = "Halaman Laporan - D`coba";
		$data['pendapatan'] = $this->laporan->jumlah_pendapatan();
		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('laporan/labarugi', $data);
		$this->load->view('_js/js_laporan');
		$this->load->view('template/footer');
	}



	public function jumlah_modala()
	{
		$data = $this->laporan->modal();
		echo json_encode($data);
	}

	public function tambah_modal_lagi()
	{
		$this->_validate_tambahmodal();
		$modal_baru = $this->input->post('modal_baru');
		$modal_sebe = $this->input->post('modal_sebe');
		$kd_keuangan = $this->input->post('kd_keuangan');
		$sis=0;

		$dataTambah = array(
				'tanggal'	=> date('yy-m-d'),
				'modal' => $this->input->post('modal_baru'),
				'sisa_modal' =>$sis
			);
		// untuk tambah modal baru
		$this->laporan->tambah_modalBaru($dataTambah);
		// untuk update sisa modal
		$sisa = $modal_baru+$modal_sebe;
		$dataUpdate = array(
				'sisa_modal' => $sisa 
		);
		$data = $this->laporan->tambah_modalLagi($kd_keuangan, $dataUpdate);
		echo json_encode(array("status" => TRUE));
	}

	public function tambah_modal_awal()
	{
		$this->_validate_tambahmodal();
		$data = array(
				'tanggal'	=> date('yy-m-d'),
				'modal' => $this->input->post('modal_baru'),
				'sisa_modal' => $this->input->post('modal_baru')
			);
		$this->laporan->tambah_modalBaru($data);
		echo json_encode(array("status" => TRUE));
	}

	public function keuangan_cetak()
	{
		$nomor_nota 	= $this->input->get('kd_keuangan');
		$tanggal		= date('d-mm-yy');
		$modal			= $this->input->get('modal');
		$pendapatan			= $this->input->get('pendapatan');
		$operasional		= $this->input->get('operasional');
		$sisa_modal		= $this->input->get('sisa_modal');
		
		$this->load->library('Cfpdf');
		$pdf = new FPDF("P","cm","A4");
		$pdf->SetMargins(2,1,1);
		 $pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','B',11);
		 $pdf->Image('http://localhost/cobajuice/upload/default.jpg',1,1,2,2);
		$pdf->SetX(4);            
		$pdf->MultiCell(19.5,0.5,'Toko UPK MANDIRI',0,'L');
		$pdf->SetX(4);
		$pdf->MultiCell(19.5,0.5,'No Hp  : 082245944110/085230512490',0,'L');    
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(4);
		$pdf->MultiCell(19.5,0.5,'Kecamatan Wringin',0,'L');
		$pdf->SetX(4);
		$pdf->MultiCell(19.5,0.5,'email : upk.wringin@gmail.com',0,'L');
		$pdf->Line(1,3.1,28.5,3.1);
		$pdf->SetLineWidth(0.1);      
		$pdf->Line(1,3.2,28.5,3.2);   
		$pdf->SetLineWidth(0);
		$pdf->ln(1);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(17,0.7,"Laporan Keuangan",0,10,'C');
		$pdf->ln(1);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
		$pdf->ln(1);
		$pdf->SetFont('Arial','B',10);

		$pdf->Cell(8.5, 0.8, 'Modal', 1, 0, 'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(8.5, 0.8, "Rp. ".number_format($modal).",-", 1, 1, 'R');


		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(8.5, 0.8, 'Pendapatan', 1, 0, 'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(8.5, 0.8, "Rp. ".number_format($pendapatan).",-", 1, 1, 'R');
 
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(8.5, 0.8, 'Operasional & lain-lain', 1, 0, 'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(8.5, 0.8, "Rp. ".number_format($operasional).",-", 1, 1, 'R');

		
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(8.5, 0.8, 'Sisa modal', 1, 0, 'L');
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(8.5, 0.8, "Rp. ".number_format($sisa_modal).",-", 1, 1, 'R');



		$n = date("Y_m_d");
		# footer
		$pdf->Ln();$pdf->Ln();
		$pdf->SetFont('Arial','',9);
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5,"Bondowoso".date('d/M/Y')."",0,'L');
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5, '',0,'C');
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5, '',0,'C');
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5, '',0,'L');
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5, '_____________________',0,'L');
		$pdf->SetX(15);
		$pdf->MultiCell(15,0.5, 'N0 : ',0,'L');
		$pdf->Output("laporan_keuangan_".$n.".pdf","I");
	}
	private function _validate_tambahmodal()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('modal_baru') == '')
		{
			$data['inputerror'][] = 'modal_baru';
			$data['error_string'][] = 'jumlah Modal baru wajib diisi lur jika mau ditambahkan';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	// tutup laporan keuangan
	// buka operasional
	public function data_operasional()
	{	
		$requestData	= $_REQUEST;
		$fetch			= $this->laporan->data_operasional($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['tanggal'];
			$datanya[]	= $row['nama_operasional'];
			$datanya[]	= "<a href='".base_url('transaksi/detail_transaksi/'.$row['tipe'])."' id='LihatDetailTransaksi'><i class='fa fa-file-text-o fa-fw'></i> ".$row['tipe']."</a>";
			$datanya[]	= $row['jumlah'];

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

	//buka laporan laba rugi
	public function data_laba()
	{
		$requestData	= $_REQUEST;
		$fetch			= $this->laporan->data_laba($requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
		
		$totalData		= $fetch['totalData'];
		$totalFiltered	= $fetch['totalFiltered'];
		$query			= $fetch['query'];

		$data	= array();
		foreach($query->result_array() as $row)
		{ 
			$datanya = array(); 

			$datanya[]	= $row['nomora'];
			$datanya[]	= $row['nama_barang'];
			$datanya[]	= $row['jumlah'];
			$datanya[]	= $row['harga_satuan'];
			$datanya[]	= $row['jumlah']*$row['harga_satuan'];

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
