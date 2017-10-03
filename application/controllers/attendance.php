<?php

class Attendance extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(array('user_model','master/alasan_m','attendance_m','presences_m'));
		$this->load->library(array('template'));
	}

	public function index(){
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

	public function pending(){
		$data = array();

		$data['count'] = $this->attendance_m->get_all_pending($this->session->userdata('user_id'))->num_rows();
		$data['pending'] = $this->attendance_m->get_all_pending($this->session->userdata('user_id'))->result_array();

		$this->template->display('attendance/pending',$data);
	}

	public function aborting($id_absen_susulan){
		if(!$id_absen_susulan){
			redirect('home');
		}else{
			$count = $this->attendance_m->get_by_id($id_absen_susulan)->num_rows();
			if($count > 0){
				$tmp = $this->attendance_m->get_by_id($id_absen_susulan)->row_array();

				if($tmp['nomor_induk']==$this->session->userdata('user_id')){
					$data_absen_susulan = array(
									'active' => '0',
									'updated_user' => $this->session->userdata('user_id'),
									'updated_date' => date('Y-m-d')
						);
					$this->attendance_m->update($id_absen_susulan,$data_absen_susulan);

					$this->session->set_flashdata('message_alert','<div class="alert alert-success">Action completed.</div>');
					redirect('attendance/pending');
				}else{
					$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. You dont have permissions to delete this data.</div>');
					redirect('attendance/pending');
				}
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. Data is not exists.</div>');
				redirect('attendance/pending');
			}
		}
	}

	public function list_approval(){
		$data = array();

		if($this->session->userdata('user_type_id')=='5'){
			redirect('home');
		}

		$data['count'] = $this->attendance_m->get_all_approval($this->session->userdata('user_id'))->num_rows();
		$data['list_approval'] = $this->attendance_m->get_all_approval($this->session->userdata('user_id'))->result_array();

		$this->template->display('attendance/list_approval',$data);
	}

	public function approve($id_absen_susulan){
		if(!$id_absen_susulan){
			redirect('home');
		}else{
			$count = $this->attendance_m->get_by_id($id_absen_susulan)->num_rows();
			if($count > 0){
				$tmp = $this->attendance_m->get_by_id($id_absen_susulan)->row_array();

				if($tmp['id_atasan']==$this->session->userdata('user_id')){
					$data_absen_susulan = array(
									'approval_atasan' => '1',
									'updated_user' => $this->session->userdata('user_id'),
									'updated_date' => date('Y-m-d')
						);
					$this->attendance_m->update($id_absen_susulan,$data_absen_susulan);

					//update or save data kehadiran
					//pertama cek dulu absen tanggal sekarang di db
					$cek = $this->presences_m->get_by_date($tmp['tanggal_absen'],$tmp['nomor_induk'])->num_rows();
					if($cek > 0){
						//jika sudah ada, beri pesan ke user bahwa jam masuk telah di input
						$dt_kehadiran = $this->presences_m->get_by_date($tmp['tanggal_absen'],$tmp['nomor_induk'])->row_array();
						$data_kehadiran = array(
											'nomor_induk' => $tmp['nomor_induk'],
											'tanggal' => $tmp['tanggal_absen'],
											'jam_masuk' => $tmp['tanggal_absen'].' 08:00:00',
											'jam_keluar' => $tmp['tanggal_absen'].' 18:00:00',
											'hadir' => '1',
											'id_alasan' => $tmp['id_alasan'],
											'id_absen_susulan' => $tmp['id_absen_susulan'],
											'keterangan' => '(Absen Susulan Approved on '.date('d-m-Y H:i:s').')',
											'created_date' => date('Y-m-d'),
											'created_user' => $this->session->userdata('user_id'),
											'updated_date' => date('Y-m-d'),
											'updated_user' => $this->session->userdata('user_id'),
											'active' => '1'
									);
						$this->presences_m->update($dt_kehadiran,$data_kehadiran);
					}else{
						//jika belum ada, save to database
						$data_kehadiran = array(
											'nomor_induk' => $tmp['nomor_induk'],
											'tanggal' => $tmp['tanggal_absen'],
											'jam_masuk' => $tmp['tanggal_absen'].' 08:00:00',
											'jam_keluar' => $tmp['tanggal_absen'].' 18:00:00',
											'hadir' => '1',
											'id_alasan' => $tmp['id_alasan'],
											'id_absen_susulan' => $tmp['id_absen_susulan'],
											'keterangan' => '(Absen Susulan Approved on '.date('d-m-Y H:i:s').')',
											'created_date' => date('Y-m-d'),
											'created_user' => $this->session->userdata('user_id'),
											'updated_date' => date('Y-m-d'),
											'updated_user' => $this->session->userdata('user_id'),
											'active' => '1'
									);
						$this->presences_m->save($data_kehadiran);
					}

					$this->session->set_flashdata('message_alert','<div class="alert alert-success">Action completed.</div>');
					redirect('attendance/list_approval');
				}else{
					$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. You dont have permissions to delete this data.</div>');
					redirect('attendance/list_approval');
				}
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. Data is not exists.</div>');
				redirect('attendance/list_approval');
			}
		}
	}

	public function tolak($id_absen_susulan){
		if(!$id_absen_susulan){
			redirect('home');
		}else{
			$count = $this->attendance_m->get_by_id($id_absen_susulan)->num_rows();
			if($count > 0){
				$tmp = $this->attendance_m->get_by_id($id_absen_susulan)->row_array();

				if($tmp['id_atasan']==$this->session->userdata('user_id')){
					$data_absen_susulan = array(
									'approval_atasan' => '1',
									'updated_user' => $this->session->userdata('user_id'),
									'updated_date' => date('Y-m-d')
						);
					$this->attendance_m->update($id_absen_susulan,$data_absen_susulan);

					//update or save data kehadiran
					//pertama cek dulu absen tanggal sekarang di db
					$cek = $this->presences_m->get_by_date($tmp['tanggal_absen'],$tmp['nomor_induk'])->num_rows();
					if($cek > 0){
						//jika sudah ada, beri pesan ke user bahwa jam masuk telah di input
						$dt_kehadiran = $this->presences_m->get_by_date($tmp['tanggal_absen'],$tmp['nomor_induk'])->row_array();
						$data_kehadiran = array(
											'nomor_induk' => $tmp['nomor_induk'],
											'tanggal' => $tmp['tanggal_absen'],
											'jam_masuk' => $tmp['tanggal_absen'].' 08:00:00',
											'jam_keluar' => $tmp['tanggal_absen'].' 18:00:00',
											'hadir' => '2',
											'id_alasan' => $tmp['id_alasan'],
											'id_absen_susulan' => $tmp['id_absen_susulan'],
											'keterangan' => '(Absen Susulan Approved on '.date('d-m-Y H:i:s').')',
											'created_date' => date('Y-m-d'),
											'created_user' => $this->session->userdata('user_id'),
											'updated_date' => date('Y-m-d'),
											'updated_user' => $this->session->userdata('user_id'),
											'active' => '1'
									);
						$this->presences_m->update($dt_kehadiran,$data_kehadiran);
					}else{
						//jika belum ada, save to database
						$data_kehadiran = array(
											'nomor_induk' => $tmp['nomor_induk'],
											'tanggal' => $tmp['tanggal_absen'],
											'jam_masuk' => $tmp['tanggal_absen'].' 08:00:00',
											'jam_keluar' => $tmp['tanggal_absen'].' 18:00:00',
											'hadir' => '2',
											'id_alasan' => $tmp['id_alasan'],
											'id_absen_susulan' => $tmp['id_absen_susulan'],
											'keterangan' => '(Absen Susulan Approved on '.date('d-m-Y H:i:s').')',
											'created_date' => date('Y-m-d'),
											'created_user' => $this->session->userdata('user_id'),
											'updated_date' => date('Y-m-d'),
											'updated_user' => $this->session->userdata('user_id'),
											'active' => '1'
									);
						$this->presences_m->save($data_kehadiran);
					}

					$this->session->set_flashdata('message_alert','<div class="alert alert-success">Action completed.</div>');
					redirect('attendance/list_approval');
				}else{
					$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. You dont have permissions to delete this data.</div>');
					redirect('attendance/list_approval');
				}
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">Action failed. Data is not exists.</div>');
				redirect('attendance/list_approval');
			}
		}
	}
}