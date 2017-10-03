<?php

class User_model extends CI_Model{
	private $table_name = 't_pegawai';
	private $table_pk = 'nomor_induk';
	private $table_status = 't_pegawai.active';
	private $table_uc = 't_user_type';
	private $table_uc_pk = 'id_jabatan';

	public function __construct(){
		parent::__construct();
	}

	public function get_by_id($user_id){
		$this->db->select('nomor_induk,
							kode_mesin,
							password,
							nama,
							tempat_lahir,
							tanggal_lahir,
							jenis_kelamin,
							alamat,
							no_telp,
							no_handphone,
							email,
							status_perkawinan,
							id_golongan,
							id_divisi,
							id_jam_kerja,
							tanggal_masuk,
							t_pegawai.active,
							nama_user_type,
							t_pegawai.id_jabatan');
		$this->db->from($this->table_name);
		$this->db->join($this->table_uc,$this->table_name.'.id_jabatan = '.$this->table_uc.'.'.$this->table_uc_pk,'INNER');
		$this->db->where($this->table_pk,$user_id);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function get_by_nik($nomor_induk){
		$this->db->select('nomor_induk,
							kode_mesin,
							password,
							nama,
							tempat_lahir,
							tanggal_lahir,
							jenis_kelamin,
							alamat,
							no_telp,
							no_handphone,
							email,
							status_perkawinan,
							id_golongan,
							id_divisi,
							id_jam_kerja,
							tanggal_masuk,
							t_pegawai.active,
							nama_user_type,
							t_pegawai.id_jabatan');
		$this->db->from($this->table_name);
		$this->db->join($this->table_uc,$this->table_name.'.id_jabatan = '.$this->table_uc.'.'.$this->table_uc_pk,'INNER');
		$this->db->where('nomor_induk',$nomor_induk);
		$this->db->where($this->table_status,'1');
		return $this->db->get();	
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('nomor_induk,kode_mesin,nama,nama_jabatan,nama_divisi,t_pegawai.active,nama_user_type');
		$this->db->from($this->table_name);
		$this->db->join($this->table_uc,$this->table_name.'.id_jabatan = '.$this->table_uc.'.'.$this->table_uc_pk,'INNER');
		$this->db->join('t_jabatan','t_jabatan.id_jabatan = t_pegawai.id_jabatan','INNER');
		$this->db->join('t_divisi','t_divisi.id_divisi = t_pegawai.id_divisi','INNER');
		$this->db->join('t_golongan','t_golongan.id_golongan = t_pegawai.id_golongan','INNER');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		$this->db->where($this->table_status,'1');
		$this->db->order_by($this->table_pk,'ASC');

		return $this->db->get();	
	}

	public function get_last_id(){
		$this->db->select($this->table_pk);
		$this->db->from($this->table_name);
		$this->db->order_by($this->table_pk,'DESC');
		$this->db->limit(1);

		return $this->db->get();
	}

	public function search_user($nomor_induk){
		$this->db->select('nomor_induk,
							kode_mesin,
							password,
							nama,
							tempat_lahir,
							tanggal_lahir,
							jenis_kelamin,
							alamat,
							no_telp,
							no_handphone,
							email,
							status_perkawinan,
							id_golongan,
							id_divisi,
							id_jam_kerja,
							tanggal_masuk,
							t_pegawai.active,
							nama_user_type,
							t_pegawai.id_jabatan');
		$this->db->from($this->table_name);
		$this->db->join($this->table_uc,$this->table_name.'.id_jabatan = '.$this->table_uc.'.'.$this->table_uc_pk,'INNER');
		$this->db->where("nomor_induk LIKE '%".$nomor_induk."%'");
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_user){
		$this->db->insert($this->table_name,$data_user);
	}

	public function update($user_id,$data_user){
		$this->db->where($this->table_pk,$user_id);
		$this->db->update($this->table_name,$data_user);
	}

	public function delete($user_id){
		$this->db->where($this->table_pk,$user_id);
		$this->db->delete($this->table_name);
	}

	public function check_login(){
		$username = $this->input->post('username');
		$password = sha1($this->input->post('password'));


		//first checking username
		if($this->get_by_nik($username)->num_rows() > 0){
			//username exist
			$data_user = $this->get_by_nik($username)->row_array();
			if(($data_user['password'] == $password) && ($data_user['active'] == '1')){
				//login success
				return true;
			}else{
				//login failed, password is not match
				return false;
			}
		}else{
			//login failed, username is not registered
			return false;
		}
	}

	public function check_absen($uname,$pwd){
		$username = $uname;
		$password = sha1($pwd);


		//first checking username
		if($this->get_by_nik($username)->num_rows() > 0){
			//username exist
			$data_user = $this->get_by_nik($username)->row_array();
			if(($data_user['password'] == $password) && ($data_user['active'] == '1')){
				//login success
				return true;
			}else{
				//login failed, password is not match
				return false;
			}
		}else{
			//login failed, username is not registered
			return false;
		}
	}
}