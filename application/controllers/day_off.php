<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class day_off extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('form_validation');
		$this->load->library('template');
	}
	
	public function index(){
		$this->template->display('day_off/day_off_view');
	}

	public function request(){
		$data = array();

		$nam = $this->user_model->get_all(false)->result_array();
		$data['listPegawai'] = $nam;

		$this->form_validation->set_rules('nomor_induk','NIP Atasan','required');
		/*$this->form_validation->set_rules('nama_atasan','Nama Atasan','required');*/

		if($this->form_validation->run()==false){
			$tmp_alasan = $this->alasan_m->get_all(false)->result_array();

			$data['atasan'] = $this->db->where('id_jabatan <> 99 and id_jabatan <> 1')->get('t_pegawai')->result_array();

			$data['alasan'] = '<select name="alasan_request" class="form-control" id="alasan_request">';
			$data['alasan'] .= '<option value="">Pilih alasan</option>';
			foreach($tmp_alasan as $alas){
				$data['alasan'] .= '<option value="'.$alas['id_alasan'].'">'.$alas['nama_alasan'].'</option>';
			}
			$data['alasan'] .= '</option>';
			$this->template->display('attendance/request',$data);
		}
		else{
			/*echo '<pre>';
			print_r($_POST);*/
			if(intval($this->input->post('count_alasan_request')) > 0){
				$tanggal = $this->input->post('send_tanggal_request');
				$id_atasan = $this->input->post('id_atasan');
				$nomor_induk = $this->input->post('nomor_induk');
				$id_alasan = $this->input->post('send_id_alasan_request');
				$keterangan = $this->input->post('send_keterangan_request');

				foreach ($tanggal as $key => $value) {
					$data_absen_susulan = array(
									'nomor_induk' => $this->session->userdata('user_id'),
									'id_atasan' => $id_atasan,
									'tanggal_absen' => $this->tanggal->tanggal_simpan_db($value),
									'id_alasan' => $id_alasan[$key],
									'keterangan' => $keterangan[$key],
									'approval_atasan' => '0',
									'created_date' => date('Y-m-d'),
									'created_user' => $this->session->userdata('user_id'),
									'active' => '1'
					);
					$this->attendance_m->save($data_absen_susulan);
				}

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data telah tersimpan</div>');
				redirect('attendance/request');
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Isi Data yang diperlukan</div>');
				redirect('attendance/request');
			}
		}
	}
}