<?php

class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_category_model');
		$this->load->model(array('master/divisi_m','master/golongan_m','master/jabatan_m','master/jam_kerja_m'));
		$this->load->library('template');
	}

	public function index(){
		$this->loginstatus->check_login();
		redirect('user/listdata');
	}

	public function listdata($start=0,$perpage=10){
		$this->loginstatus->check_login();
		$data = array();

		$count = $this->user_model->get_all(false)->num_rows();

		// echo $count;

		// $start = 2;
		$data['user'] = $this->user_model->get_all(true,$start,$perpage)->result_array();

		// print_r($data['user']);die();

		$this->load->library('pagination');
		$config['base_url'] = base_url().'user/listdata/';
		$config['total_rows'] = $count;
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$data['paging'] = $this->pagination->create_links();
		$data['number'] = $start + 1;

		$this->template->display('user/listdata_view',$data);
	}

	public function add(){
		$this->loginstatus->check_login();
		$this->form_validation->set_rules('nomor_induk','Nomor Induk','required');
		$this->form_validation->set_rules('kode_mesin','Kode Mesin','required');
		$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','required');
		$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
		$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('no_telepon','No Telepon','numeric');
		$this->form_validation->set_rules('no_handphone','No Handphone','required|numeric');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('status_perkawinan','Status Perkawinan','required');
		$this->form_validation->set_rules('id_divisi','Divisi','required');
		$this->form_validation->set_rules('id_jabatan','Jabatan','required');
		$this->form_validation->set_rules('id_golongan','Golongan','required');
		$this->form_validation->set_rules('id_jam_kerja','Jam Kerja','required');
		$this->form_validation->set_rules('tanggal_masuk','Tanggal Masuk','required');
		if($this->form_validation->run()==FALSE){
			$data = array();

			//load select box divisi
			$div = $this->divisi_m->get_all(false)->result_array();
			$data['divisi'] = '<select name="id_divisi" id="id_divisi" class="form-control" required="required">';
			$data['divisi'] .= '<option value="">Pilih Divisi</option>';
			foreach($div as $d){
				$data['divisi'] .= '<option value="'.$d['id_divisi'].'">'.$d['nama_divisi'].'</option>';
			}
			$data['divisi'] .= '</select>';

			//load select box jabatan
			$jab = $this->jabatan_m->get_all(false)->result_array();
			$data['jabatan'] = '<select name="id_jabatan" id="id_jabatan" class="form-control" required="required">';
			$data['jabatan'] .= '<option value="">Pilih Jabatan</option>';
			foreach($jab as $j){
				$data['jabatan'] .= '<option value="'.$j['id_jabatan'].'">'.$j['nama_jabatan'].'</option>';
			}
			$data['jabatan'] .= '</select>';

			//load select box golongan
			$gol = $this->golongan_m->get_all(false)->result_array();
			$data['golongan'] = '<select name="id_golongan" id="id_golongan" class="form-control" required="required">';
			$data['golongan'] .= '<option value="">Pilih Golongan</option>';
			foreach($gol as $g){
				$data['golongan'] .= '<option value="'.$g['id_golongan'].'">'.$g['nama_golongan'].'</option>';
			}
			$data['golongan'] .= '</select>';

			//load select box jam kerja
			$jam = $this->jam_kerja_m->get_all(false)->result_array();
			$data['jam_kerja'] = '<select name="id_jam_kerja" id="id_jam_kerja" class="form-control" required="required">';
			$data['jam_kerja'] .= '<option value="">Pilih Jam Kerja</option>';
			foreach ($jam as $jm){
				$data['jam_kerja'] .= '<option value="'.$jm['id_jam_kerja'].'">'.$jm['keterangan'].'</option>';
			}
			$data['jam_kerja'] .= '</select>';

			$this->template->display('user/add_view',$data);
		}else{
			//generate NI
			$Nomor_Induk = $this->generateNIK();

			$data_user = array(
							//'nomor_induk' => $Nomor_Induk,
							'nomor_induk' => $this->input->post('nomor_induk'),
							'kode_mesin' => $this->input->post('kode_mesin'),
							'nama' => $this->input->post('nama_karyawan'),
							'tempat_lahir' => $this->input->post('tempat_lahir'),
							'tanggal_lahir' => $this->tanggal->tanggal_simpan_db($this->input->post('tanggal_lahir')),
							'jenis_kelamin' => $this->input->post('jenis_kelamin'),
							'alamat' => $this->input->post('alamat'),
							'no_telp' => $this->input->post('no_telp'),
							'no_handphone' => $this->input->post('no_handphone'),
							'email' => $this->input->post('email'),
							'status_perkawinan' => $this->input->post('status_perkawinan'),
							'id_jabatan' => $this->input->post('id_jabatan'),
							'id_golongan' => $this->input->post('id_golongan'),
							'id_divisi' => $this->input->post('id_divisi'),
							'id_jam_kerja' => $this->input->post('id_jam_kerja'),
							'tanggal_masuk' => $this->tanggal->tanggal_simpan_db($this->input->post('tanggal_masuk')),
							'password' => sha1('password'),
							'created_user' => $this->session->userdata('user_id'),
							'created_date' => date('Y-m-d H:i:s'),
							'active' => '1'
						);
			$this->user_model->save($data_user);

			$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been saved.</div>');

			redirect('user/listdata');
		}
	}

	public function edit($id){
		$this->loginstatus->check_login();
		if($id){
			$this->form_validation->set_rules('nomor_induk','Nomor Induk','required');
			$this->form_validation->set_rules('nama_karyawan','Nama Karyawan','required');
			$this->form_validation->set_rules('kode_mesin','Kode Mesin','required');
			$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','required');
			$this->form_validation->set_rules('tanggal_lahir','Tanggal Lahir','required');
			$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('no_telepon','No Telepon','numeric');
			$this->form_validation->set_rules('no_handphone','No Handphone','required|numeric');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('status_perkawinan','Status Perkawinan','required');
			$this->form_validation->set_rules('id_divisi','Divisi','required');
			$this->form_validation->set_rules('id_jabatan','Jabatan','required');
			$this->form_validation->set_rules('id_golongan','Golongan','required');
			$this->form_validation->set_rules('id_jam_kerja','Jam Kerja','required');
			$this->form_validation->set_rules('tanggal_masuk','Tanggal Masuk','required');

			if($this->form_validation->run()==FALSE){
				$data = array();

				$count = $this->user_model->get_by_id($id)->num_rows();
				if($count > 0){
					$data['user'] = $this->user_model->get_by_id($id)->row_array();

					//load select box divisi
					$div = $this->divisi_m->get_all(false)->result_array();
					$data['divisi'] = '<select name="id_divisi" id="id_divisi" class="form-control" required="required">';
					$data['divisi'] .= '<option value="">Pilih Divisi</option>';
					foreach($div as $d){
						$selected = '';
						if($data['user']['id_divisi']==$d['id_divisi']){
							$selected = 'selected';
						}
						$data['divisi'] .= '<option value="'.$d['id_divisi'].'" '.$selected.'>'.$d['nama_divisi'].'</option>';
					}
					$data['divisi'] .= '</select>';

					//load select box jabatan
					$jab = $this->jabatan_m->get_all(false)->result_array();
					$data['jabatan'] = '<select name="id_jabatan" id="id_jabatan" class="form-control" required="required">';
					$data['jabatan'] .= '<option value="">Pilih Jabatan</option>';
					foreach($jab as $j){
						$selected = '';
						if($data['user']['id_jabatan']==$j['id_jabatan']){
							$selected = 'selected';
						}
						$data['jabatan'] .= '<option value="'.$j['id_jabatan'].'" '.$selected.'>'.$j['nama_jabatan'].'</option>';
					}
					$data['jabatan'] .= '</select>';

					//load select box golongan
					$gol = $this->golongan_m->get_all(false)->result_array();
					$data['golongan'] = '<select name="id_golongan" id="id_golongan" class="form-control" required="required">';
					$data['golongan'] .= '<option value="">Pilih Golongan</option>';
					foreach($gol as $g){
						$selected = '';
						if($data['user']['id_golongan']==$g['id_golongan']){
							$selected = 'selected';
						}
						$data['golongan'] .= '<option value="'.$g['id_golongan'].'" '.$selected.'>'.$g['nama_golongan'].'</option>';
					}
					$data['golongan'] .= '</select>';

					//load select box jam kerja
					$jam = $this->jam_kerja_m->get_all(false)->result_array();
					$data['jam_kerja'] = '<select name="id_jam_kerja" id="id_jam_kerja" class="form-control" required="required">';
					$data['jam_kerja'] .= '<option value="">Pilih Jam Kerja</option>';
					foreach ($jam as $jm){
						$selected = '';
						if($data['user']['id_jam_kerja']==$jm['id_jam_kerja']){
							$selected = 'selected';
						}
						$data['jam_kerja'] .= '<option value="'.$jm['id_jam_kerja'].'" '.$selected.'>'.$jm['keterangan'].'</option>';
					}
					$data['jam_kerja'] .= '</select>';

					//generate selectbox perkawinan
					$status_perkawinan_option_0 = '';
					$status_perkawinan_option_1 = '';
					$status_perkawinan_option_2 = '';
					$status_perkawinan_option_3 = '';
					if($data['user']['status_perkawinan']=='0'){
						$status_perkawinan_option_1 = 'selected';
					}
					if($data['user']['status_perkawinan']=='1'){
						$status_perkawinan_option_1 = 'selected';
					}
					if($data['user']['status_perkawinan']=='2'){
						$status_perkawinan_option_2 = 'selected';
					}
					if($data['user']['status_perkawinan']=='3'){
						$status_perkawinan_option_3 = 'selected';
					}
					$data['status_perkawinan'] = '<select name="status_perkawinan" id="status_perkawinan" required="required" class="form-control">
													<option value="" '.$status_perkawinan_option_0.'>Pilih Status Perkawinan</option>
													<option value="1" '.$status_perkawinan_option_1.'>Lajang</option>
													<option value="2" '.$status_perkawinan_option_2.'>Menikah</option>
													<option value="3" '.$status_perkawinan_option_3.'>Cerai</option>
												</select>';

					//setting up for jenis kelamin
					$jenis_kelamin_checked_1 = '';
					$jenis_kelamin_checked_2 = '';

					if($data['user']['jenis_kelamin']=='1'){
						$jenis_kelamin_checked_1 = 'checked';
					}

					if($data['user']['jenis_kelamin']=='2'){
						$jenis_kelamin_checked_2 = 'checked';
					}

					$data['jenis_kelamin'][1] = $jenis_kelamin_checked_1;
					$data['jenis_kelamin'][2] = $jenis_kelamin_checked_2;

					$this->template->display('user/edit_view',$data);
				}else{
					$this->session->set_flashdata('message_alert','<div class="alert alert-danger">The ID you\'ve choosen not registered.</div>');
					redirect('user/listdata');
				}	
			}else{
				$data_user = array(
							'nomor_induk' => $this->input->post('nomor_induk'),
							'kode_mesin' => $this->input->post('kode_mesin'),
							'nama' => $this->input->post('nama_karyawan'),
							'tempat_lahir' => $this->input->post('tempat_lahir'),
							'tanggal_lahir' => $this->tanggal->tanggal_simpan_db($this->input->post('tanggal_lahir')),
							'jenis_kelamin' => $this->input->post('jenis_kelamin'),
							'alamat' => $this->input->post('alamat'),
							'no_telp' => $this->input->post('no_telp'),
							'no_handphone' => $this->input->post('no_handphone'),
							'email' => $this->input->post('email'),
							'status_perkawinan' => $this->input->post('status_perkawinan'),
							'id_jabatan' => $this->input->post('id_jabatan'),
							'id_golongan' => $this->input->post('id_golongan'),
							'id_divisi' => $this->input->post('id_divisi'),
							'id_jam_kerja' => $this->input->post('id_jam_kerja'),
							'tanggal_masuk' => $this->tanggal->tanggal_simpan_db($this->input->post('tanggal_masuk')),
							'password' => sha1('password'),
							'updated_user' => $this->session->userdata('user_id'),
							'updated_date' => date('Y-m-d H:i:s')
						);
				$this->user_model->update($id,$data_user);

				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been updated.</div>');

				redirect('user/listdata');
			}
		}else{
			redirect('user/listdata');
		}
	}

	public function delete($id){
		$this->loginstatus->check_login();
		if($id){
			$count = $this->user_model->get_by_id($id)->num_rows();
			if($count > 0){
				$data_user = array(
									'active' => '0'
				);
				$this->user_model->update($id,$data_user);
				$this->session->set_flashdata('message_alert','<div class="alert alert-success">Data has been deleted.</div>');

				redirect('user/listdata');
			}else{
				$this->session->set_flashdata('message_alert','<div class="alert alert-danger">The ID you\'ve choosen not registered.</div>');
				redirect('user/listdata');
			}
		}else{
			redirect('user/listdata');
		}
	}

	public function login(){
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()==FALSE){
			$this->load->view('user/login_view');
		}else{
			if($this->user_model->check_login()){
				//login success, save to session
				$data_user = $this->user_model->get_by_nik($this->input->post('username'))->row_array();
				$user_sess = array(
								'user_id' => $data_user['nomor_induk'],
								'user_km' => $data_user['kode_mesin'],
								'user_fullname' => $data_user['nama'],
								'user_type_id' => $data_user['id_jabatan'],
								'logged_in' => true
							);
				$this->session->set_userdata($user_sess);

				redirect('home');
			}else{
				$this->session->set_flashdata('login_failed','<div class="alert alert-danger">Username or password is not registered.</div>');
				redirect('user/login');
			}
		}
	}

	public function logout(){
		$this->loginstatus->check_login();
		$this->session->sess_destroy();
		redirect('user/login');
	}

	public function check_username_availabilities(){
		$nomor_induk = $this->input->post('username');
		//$username = 'administratorw';

		$data = array();
		$count = $this->user_model->get_by_nik($nomor_induk)->num_rows();

		if($count > 0){
			$data['status'] = false;
		}else{
			$data['status'] = true;
		}

		echo json_encode($data);
	}

	public function getUserAPI(){
		$nomor_induk = $this->input->get('name_startsWith');

		$data = array();
		$count = $this->user_model->search_user($nomor_induk)->num_rows();

		
		$userdata = $this->user_model->search_user($nomor_induk)->result_array();

		$i = 0;
		foreach($userdata as $row){
			$data['data_pegawai'][$i]['nomor_induk'] = $row['nomor_induk'];
			$data['data_pegawai'][$i]['kode_mesin'] = $row['kode_mesin'];
			$data['data_pegawai'][$i]['nama'] = $row['nama'];
			$i++;
		}

		$data['total'] = $count;

		echo json_encode($data);
	}

	public function generateNIK(){
		$count = $this->user_model->get_last_id()->num_rows();
		if($count > 0){
			$lastdata = $this->user_model->get_last_id()->row_array();

			if($lastdata['nomor_induk'] > 100000){
				$NIK = ($lastdata['nomor_induk']+1);
			}elseif($lastdata['nomor_induk'] > 10000){
				$NIK = '0'.($lastdata['nomor_induk']+1);
			}elseif($lastdata['nomor_induk'] > 1000){
				$NIK = '00'.($lastdata['nomor_induk']+1);
			}elseif($lastdata['nomor_induk'] > 100){
				$NIK = '000'.($lastdata['nomor_induk']+1);
			}elseif($lastdata['nomor_induk'] > 10){
				$NIK = '0000'.($lastdata['nomor_induk']+1);
			}else{
				$NIK = '00000'.($lastdata['nomor_induk']+1);
			}
		}else{
			$NIK = '000001';
		}

		return $NIK;
	}
}