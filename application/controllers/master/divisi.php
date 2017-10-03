<?php

class Divisi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model('master/divisi_m');
	}

	public function index(){
		redirect('master/divisi/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$data = array();

		$count = $this->divisi_m->get_all(false)->num_rows();
		$data['divisi'] = $this->divisi_m->get_all(true,$start,$perpage)->result_array();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'master/divisi/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('master/divisi/listdata_view',$data);
	}

	public function add(){
		$this->form_validation->set_rules('divisi_name','Nama Divisi','required');

		if($this->form_validation->run()==FALSE){
			$this->template->display('master/divisi/add_view');
		}else{
			$data_divisi = array(
									'nama_divisi' => $this->input->post('divisi_name'),
									'created_date' => date('Y-m-d'),
									'created_user' => $this->session->userdata('user_id'),
									'active' => '1'
				);
			$this->divisi_m->save($data_divisi);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been saved.</div>');

			redirect('master/divisi/listdata');
		}
	}

	public function edit($id){
		if($id){
			$this->form_validation->set_rules('divisi_name','Nama Divisi','required');

			if($this->form_validation->run()==FALSE){
				$data = array();

				$count = $this->divisi_m->get_by_id($id)->num_rows();
				if($count > 0){
					$data['divisi'] = $this->divisi_m->get_by_id($id)->row_array();

					$this->template->display('master/divisi/edit_view',$data);
				}else{
					redirect('master/divisi/listdata');
				}
			}else{
				$data_divisi = array(
										'nama_divisi' => $this->input->post('divisi_name'),
										'updated_date' => date('Y-m-d'),
										'updated_user' => $this->session->userdata('user_id')
					);
				$this->divisi_m->update($id,$data_divisi);

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been updated.</div>');

				redirect('master/divisi/listdata');
			}
		}else{
			redirect('master/divisi/listdata');
		}
	}

	public function delete($id){
		if($id){
			$count = $this->divisi_m->get_by_id($id)->num_rows();
			if($count > 0){
				$data_divisi = array(
									'updated_date' => date('Y-m-d'),
									'updated_user' => $this->session->userdata('user_id'),
									'active' => '0'
				);
				$this->divisi_m->update($id,$data_divisi);
				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been deleted.</div>');

				redirect('master/divisi/listdata');
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">The ID you\'ve choosen not registered.</div>');
				redirect('master/divisi/listdata');
			}
		}else{
			redirect('master/divisi/listdata');
		}
	}
}