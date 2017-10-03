<?php
class report_to_pdf extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model('presences_m');
		$this->load->model('user_model');
	}

	public function index(){
		$this->template->display('presences/rekap_periode');
	}

	public function print_laporan_eachPegawai(){
		if ($this->input->get('nomor_induk') != null){
			$nomorInduk = $this->input->get('nomor_induk');
		}else{
			$nomorInduk = $this->session->userdata('user_id');
		}
		$dateStart = $this->input->get('date_start');
		$dateEnd = $this->input->get('date_end');
		// $nomorInduk = $this->input->get('nomor_induk');

		$dateStart = $this->formatDate($dateStart);
		$dateEnd = $this->formatDate($dateEnd);
		
		$detailPegawai = $this->user_model->get_by_nik($nomorInduk)->row();

		$listKehadiran = $this->presences_m->get_by_range($dateStart, $dateEnd, $nomorInduk)->result();

		/*echo "<pre>";
		print_r($detailPegawai);
		echo "</pre>";
		die();*/

		$this->template->display('presences/laporan_pegawai');
	
		$this->load->library('fpdf_gen');
		$this->fpdf->AddPage('P' , 'A4');
		
		$this->fpdf->SetFont('Arial','B',16);
		$this->fpdf->Cell(0,10,'Laporan Absensi Kepegawaian',0,0,'C');  /*lebar,tinggi*/
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,10,'Pascasarjana Universitas Diponegoro',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,7,'Nama	: '. $detailPegawai->nama); 
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,7,'NIP	    : '. $detailPegawai->nomor_induk); 
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->SetFont('Times','B',12,'C');
		$this->fpdf->Cell(10 , 7, 'No', 1, 'LR', 'C');
		$this->fpdf->Cell(30 , 7, 'Tanggal', 1, 'LR', 'C');
		$this->fpdf->Cell(30 , 7, 'Kehadiran', 1, 'LR', 'C');
		$this->fpdf->Cell(30 , 7, 'Jam Masuk', 1, 'LR', 'C');
		$this->fpdf->Cell(30 , 7, 'Jam Pulang', 1, 'LR', 'C');
		$this->fpdf->Cell(50 , 7, 'Alasan Tidak Hadir', 1, 'LR', 'C');

		if(sizeof($listKehadiran)>0){
			$no = 1;
			$y = 8;

			$this->fpdf->SetFont('Times','',12,'C');
			foreach ($listKehadiran as $key => $eachKehadiran) {
				$this->fpdf->Ln();
				
				if($eachKehadiran->id_alasan!=7){
					$kehadiran = 'Tidak hadir';
					$alasan = $eachKehadiran->nama_alasan;
				}else{
					$kehadiran = 'Hadir';
					$alasan = '-';
				}

				$this->fpdf->Cell(10 , $y, $no, 1, 'LR', 'C');
				$this->fpdf->Cell(30 , $y, $eachKehadiran->tanggal, 1, 'LR', 'C');
				$this->fpdf->Cell(30 , $y, $kehadiran, 1, 'LR', 'C');
				$this->fpdf->Cell(30 , $y, $eachKehadiran->jam_masuk, 1, 'LR', 'C');
				$this->fpdf->Cell(30 , $y, $eachKehadiran->jam_keluar, 1, 'LR', 'C');
				$this->fpdf->Cell(50 , $y, $alasan, 1, 'LR', 'C');

				$no++;

			}
		}else{
			$this->fpdf->Ln();
			$this->fpdf->Cell(180 , 10, 'Tidak ada data presensi', 1, 'LR', 'C');
		}

		
		$this->fpdf->Output('laporan_pergawai.pdf','I');
	}

	public function print_rekap(){

		$this->template->display('presences/rekap_periode');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$namaEachPerson = array();

		$bulan = 8;
		$tahun = 2017;

		$listAlasan = $this->presences_m->get_all_alasan()->result();

		$initAlasan = array();

		foreach ($listAlasan as $key => $eachAlasan) {
			$initAlasan[$eachAlasan->nama_alasan] = 0;
		}

		$listAllRekap = $this->presences_m->get_rekap($bulan, $tahun)->result();
		/*echo "<pre>";
		print_r($listAllRekap);
		echo "</pre>";
		die();*/
		foreach ($listAllRekap as $key => $eachRekap) {
			
			$rekapEachPerson[$eachRekap->nomor_induk] = $initAlasan;
			$namaEachPerson[$eachRekap->nomor_induk] = $eachRekap->nama;

		}

		foreach ($listAllRekap as $key => $eachRekap) {

			$rekapEachPerson[$eachRekap->nomor_induk][$eachRekap->nama_alasan]++;

		}

		/*$listNama = $this->user_model->get_all()->result();

		foreach ($listNama as $key => $eachNama) {

			$rekapNama[$eachNama->nama]++;

		}*/
/*		echo "<pre>";
		print_r($rekapNama);
		echo "</pre>";
		die();
	*/
		$this->load->library('fpdf_gen');

		$this->fpdf->AddPage('L' , 'A4');
		
		$this->fpdf->SetFont('Arial','B',16);
		$this->fpdf->Cell(0,10,'Rekap Absensi Kepegawaian',0,0,'C');  /*lebar,tinggi*/
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,10,'Pascasarjana Universitas Diponegoro',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,7,'Bulan	: '. $bulan); 
		$this->fpdf->Ln();
		$this->fpdf->Cell(0,7,'Tahun	: '. $tahun); 
		$this->fpdf->Ln();
		$this->fpdf->Ln();
		$this->fpdf->SetFont('Times','B',10,'C');
		$this->fpdf->Cell(40 , 7, 'NIP', 1, 'LR', 'C');
		$this->fpdf->Cell(80 , 7, 'Nama', 1, 'LR', 'C');

		// print_r($rekapEachPerson);
		// print_r($listAlasan);die();
		
		foreach ($listAlasan as $key => $eachAlasan) {
			$this->fpdf->Cell(20 , 7, $eachAlasan->nama_alasan, 1, 'LR', 'C');
		}

		foreach ($rekapEachPerson as $key => $eachPerson) {
			/*foreach (array_combine($rekapEachPerson, $rekapNama) as $key => $eachPerson){*/
			$this->fpdf->Ln();
			$this->fpdf->Cell(40 , 7, $key, 1, 'LR', 'C');
		
			//ambil nama berdasarkan nomor induk

			$this->fpdf->Cell(80 , 7, $namaEachPerson[$key], 1, 'LR', 'C');

			foreach ($eachPerson as $key2 => $value) {
				$this->fpdf->Cell(20 , 7, $value, 1, 'LR', 'C');
			}

		}

		
		$this->fpdf->Output('rekap_periode.pdf','I');

		/*echo "<pre>";
		print_r($rekapEachPerson);
		echo "</pre>";
		die();*/
	}

	private function formatDate($date){
		$parts =  explode('/',$date);

		$date	= $parts[2].'-'.$parts[1].'-'.$parts[0];
		
		return $date;
	}
}