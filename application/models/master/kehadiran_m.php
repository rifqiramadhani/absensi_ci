<?php

class Jam_kerja_m extends CI_Model{
	private $table_name = 't_kehdiran';
	
	public function __construct(){
		parent::__construct();
	}

	public function save_kehadiran($data)){
		$this->
	}

	public function get_by_id($id_divisi){
		$this->db->select('id_jam_kerja,jam_masuk,jam_keluar,keterangan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_pk,$id_divisi);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_divisi){
		$this->db->insert($this->table_name,$data_divisi);
	}

	public function update($id_divisi,$data_divisi){
		$this->db->where($this->table_pk,$id_divisi);
		$this->db->update($this->table_name,$data_divisi);
	}

	public function delete($id_divisi){
		$this->db->where($this->table_pk,$id_divisi);
		$this->db->delete($this->table_name);
	}
}