<?php

class Jabatan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model('master/jabatan_m');
	}

	public function index(){
		redirect('master/jabatan/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$data = array();

		$count = $this->jabatan_m->get_all(false)->num_rows();
		$data['jabatan'] = $this->jabatan_m->get_all(true,$start,$perpage)->result_array();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'master/jabatan/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('master/jabatan/listdata_view',$data);
	}

	public function add(){
		$this->form_validation->set_rules('jabatan_name','Nama Jabatan','required');

		if($this->form_validation->run()==FALSE){
			$this->template->display('master/jabatan/add_view');
		}else{
			$data_jabatan = array(
									'nama_jabatan' => $this->input->post('jabatan_name'),
									'created_date' => date('Y-m-d'),
									'created_user' => $this->session->userdata('user_id'),
									'active' => '1'
				);
			$this->jabatan_m->save($data_jabatan);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been saved.</div>');

			redirect('master/jabatan/listdata');
		}
	}

	public function edit($id){
		if($id){
			$this->form_validation->set_rules('jabatan_name','Nama Jabatan','required');

			if($this->form_validation->run()==FALSE){
				$data = array();

				$count = $this->jabatan_m->get_by_id($id)->num_rows();
				if($count > 0){
					$data['jabatan'] = $this->jabatan_m->get_by_id($id)->row_array();

					$this->template->display('master/jabatan/edit_view',$data);
				}else{
					redirect('master/jabatan/listdata');
				}
			}else{
				$data_jabatan = array(
										'nama_jabatan' => $this->input->post('jabatan_name'),
										'updated_date' => date('Y-m-d'),
										'updated_user' => $this->session->userdata('user_id')
					);
				$this->jabatan_m->update($id,$data_jabatan);

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been updated.</div>');

				redirect('master/jabatan/listdata');
			}
		}else{
			redirect('master/jabatan/listdata');
		}
	}

	public function delete($id){
		if($id){
			$count = $this->jabatan_m->get_by_id($id)->num_rows();
			if($count > 0){
				$data_jabatan = array(
									'updated_date' => date('Y-m-d'),
									'updated_user' => $this->session->userdata('user_id'),
									'active' => '0'
				);
				$this->jabatan_m->update($id,$data_jabatan);
				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been deleted.</div>');

				redirect('master/jabatan/listdata');
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">The ID you\'ve choosen not registered.</div>');
				redirect('master/jabatan/listdata');
			}
		}else{
			redirect('master/jabatan/listdata');
		}
	}
}