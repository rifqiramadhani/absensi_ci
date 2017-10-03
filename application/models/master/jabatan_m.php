<?php

class Jabatan_m extends CI_Model{
	private $table_name = 't_jabatan';
	private $table_pk = 'id_jabatan';
	private $table_status = 't_jabatan.active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_jabatan,nama_jabatan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($id_jabatan){
		$this->db->select('id_jabatan,nama_jabatan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_pk,$id_jabatan);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_jabatan){
		$this->db->insert($this->table_name,$data_jabatan);
	}

	public function update($id_jabatan,$data_jabatan){
		$this->db->where($this->table_pk,$id_jabatan);
		$this->db->update($this->table_name,$data_jabatan);
	}

	public function delete($id_jabatan){
		$this->db->where($this->table_pk,$id_jabatan);
		$this->db->delete($this->table_name);
	}
}