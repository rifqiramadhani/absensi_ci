<?php

class User_category extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->loginstatus->check_login();
		$this->load->library('template');
		$this->load->model('user_category_model');
		$this->load->model('master/jabatan_m');
	}

	public function index(){
		redirect('user_category/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$data = array();

		$count = $this->user_category_model->get_all(false)->num_rows();
		$data['user_category'] = $this->user_category_model->get_all(true,$start,$perpage)->result_array();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user_category/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('user_category/listdata_view',$data);
	}

	public function add(){
		$this->form_validation->set_rules('user_type_name','Nama Tipe User','required');
		$this->form_validation->set_rules('id_jabatan','Jabatan','required');

		if($this->form_validation->run()==FALSE){
			$data = array();

			$jabatan = $this->jabatan_m->get_all(false)->result_array();

			$data['jabatan'] = '<select name="id_jabatan" class="form-control" id="id_jabatan" required>';
			$data['jabatan'] .= '<option value="">Pilih Jabatan</option>';
			foreach ($jabatan as $row) {
				$data['jabatan'] .= '<option value="'.$row['id_jabatan'].'">'.$row['nama_jabatan'].'</option>';
			}
			$data['jabatan'] .= '</select>';
			$this->template->display('user_category/add_view',$data);
		}else{
			$data_user_category = array(
									'nama_user_type' => $this->input->post('user_type_name'),
									'id_jabatan' => $this->input->post('id_jabatan'),
									'created_date' => date('Y-m-d'),
									'created_user' => $this->session->userdata('user_id'),
									'active' => '1'
				);
			$this->user_category_model->save($data_user_category);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been saved.</div>');

			redirect('user_category/listdata');
		}
	}

	public function edit($id){
		if($id){
			$this->form_validation->set_rules('user_type_name','Nama Tipe User','required');

			if($this->form_validation->run()==FALSE){
				$data = array();

				$count = $this->user_category_model->get_by_id($id)->num_rows();
				if($count > 0){
					$data['user_category'] = $this->user_category_model->get_by_id($id)->row_array();

					$jabatan = $this->jabatan_m->get_all(false)->result_array();
					$data['jabatan'] = '<select name="id_jabatan" class="form-control" id="id_jabatan" required>';
					$data['jabatan'] .= '<option value="">Pilih Jabatan</option>';
					foreach ($jabatan as $row) {
						$selected = '';
						if($data['user_category']['id_jabatan']==$row['id_jabatan']){
							$selected = 'selected';
						}
						$data['jabatan'] .= '<option value="'.$row['id_jabatan'].'" '.$selected.'>'.$row['nama_jabatan'].'</option>';
					}
					$data['jabatan'] .= '</select>';

					$this->template->display('user_category/edit_view',$data);
				}else{
					redirect('user_category/listdata');
				}
			}else{
				$data_user_category = array(
										'nama_user_type' => $this->input->post('user_type_name'),
										'id_jabatan' => $this->input->post('id_jabatan'),
										'updated_date' => date('Y-m-d'),
										'updated_user' => $this->session->userdata('user_id'),
					);
				$this->user_category_model->update($id,$data_user_category);

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been updated.</div>');

				redirect('user_category/listdata');
			}
		}else{
			redirect('user_category/listdata');
		}
	}

	public function delete($id){
		if($id){
			$count = $this->user_category_model->get_by_id($id)->num_rows();
			if($count > 0){
				$data_user_category = array(
									'active' => '0'
				);
				$this->user_category_model->update($id,$data_user_category);
				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been deleted.</div>');

				redirect('user_category/listdata');
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">The ID you\'ve choosen not registered.</div>');
				redirect('user_category/listdata');
			}
		}else{
			redirect('user_category/listdata');
		}
	}
}