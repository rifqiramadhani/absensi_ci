<?php

class Jam_kerja extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model(array('master/jam_kerja_m'));
	}

	public function index(){
		redirect('master/jam_kerja/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$data = array();

		$count = $this->jam_kerja_m->get_all(false)->num_rows();
		$data['jam_kerja'] = $this->jam_kerja_m->get_all(true,$start,$perpage)->result_array();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'master/jam_kerja/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('master/jam_kerja/listdata_view',$data); 
	}

	public function add(){
		$this->form_validation->set_rules('master_jam_masuk','Jam Masuk','required');
		$this->form_validation->set_rules('master_jam_keluar','Jam Keluar','required');
		if($this->form_validation->run()==FALSE){
			$this->template->display('master/jam_kerja/add_view');
		}else{
			$tmp_jam_masuk = substr($this->input->post('master_jam_masuk'), 0, 5);
			$tmp_jam_keluar = substr($this->input->post('master_jam_keluar'), 0, 5);
			$ampm_masuk = substr($this->input->post('master_jam_masuk'), 5,2);
			$ampm_keluar = substr($this->input->post('master_jam_keluar'), 5,2);

			$jam_masuk = $this->tanggal->convert_to_24($tmp_jam_masuk,$ampm_masuk);
			$jam_keluar = $this->tanggal->convert_to_24($tmp_jam_keluar,$ampm_keluar);

			$data_jam_kerja = array(
								'jam_masuk' => $jam_masuk,
								'jam_keluar' => $jam_keluar,
								'keterangan' => $this->input->post('master_keterangan'),
								'active' => '1',
								'created_date' => date('Y-m-d H:i:s'),
								'created_user' => $this->session->userdata('user_id')
						);
			$this->jam_kerja_m->save($data_jam_kerja);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been saved.</div>');

			redirect('master/jam_kerja/listdata');
		}
	}

	public function edit($id){
		if(!$id){
			redirect('home');
		}else{
			$tmp_jam_masuk = substr($this->input->post('master_jam_masuk'), 0, 5);
			$tmp_jam_keluar = substr($this->input->post('master_jam_keluar'), 0, 5);
			$ampm_masuk = substr($this->input->post('master_jam_masuk'), 5,2);
			$ampm_keluar = substr($this->input->post('master_jam_keluar'), 5,2);

			$jam_masuk = $this->tanggal->convert_to_24($tmp_jam_masuk,$ampm_masuk);
			$jam_keluar = $this->tanggal->convert_to_24($tmp_jam_keluar,$ampm_keluar);

			$this->form_validation->set_rules('master_jam_masuk','Jam Masuk','required');
			$this->form_validation->set_rules('master_jam_keluar','Jam Keluar','required');
			if($this->form_validation->run()==FALSE){
				$data = array();

				$count = $this->jam_kerja_m->get_by_id($id)->num_rows();
				if($count > 0){
					$data = array();

					$data['jam_kerja'] = $this->jam_kerja_m->get_by_id($id)->row_array();
					$data['jam_masuk'] = $this->tanggal->convert_to_12($data['jam_kerja']['jam_masuk']);
					$data['jam_keluar'] = $this->tanggal->convert_to_12($data['jam_kerja']['jam_keluar']);

					$this->template->display('master/jam_kerja/edit_view',$data);
				}else{
					$this->session->set_flashdata('message_alert','<div class="alert alert-error">The ID\'s you\'ve been entered is not registered.</div>');

					redirect('master/jam_kerja/listdata');
				}
			}else{
				$data_jam_kerja = array(
									'jam_masuk' => $jam_masuk,
									'jam_keluar' => $jam_keluar,
									'keterangan' => $this->input->post('master_keterangan'),
									'updated_date' => date('Y-m-d H:i:s'),
									'updated_user' => $this->session->userdata('user_id')
					);
				$this->jam_kerja_m->update($id,$data_jam_kerja);

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been updated.</div>');

				redirect('master/jam_kerja/listdata');
			}
		}
	}

	public function delete($id){
		if(!$id){
			redirect('home');
		}else{
			$data_jam_kerja = array(
								'active' => '0',
								'updated_date' => date('Y-m-d H:i:s'),
								'updated_user' => $this->session->userdata('user_id')
				);
			$this->jam_kerja_m->update($id,$data_jam_kerja);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been deleted.</div>');

			redirect('master/jam_kerja/listdata');
		}
	}
}