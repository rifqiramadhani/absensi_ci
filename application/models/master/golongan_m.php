<?php

class Golongan_m extends CI_Model{
	private $table_name = 't_golongan';
	private $table_pk = 'id_golongan';
	private $table_status = 't_golongan.active';

	public function __construct(){
		parent::__construct();
	}

	public function get_all($paging=true,$start=0,$limit=10){
		$this->db->select('id_golongan,nama_golongan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_status,'1');
		if($paging==true){
			$this->db->limit($limit,$start);
		}
		return $this->db->get();
	}

	public function get_by_id($id_golongan){
		$this->db->select('id_golongan,nama_golongan,created_date,created_user,active');
		$this->db->from($this->table_name);
		$this->db->where($this->table_pk,$id_golongan);
		$this->db->where($this->table_status,'1');
		return $this->db->get();
	}

	public function save($data_golongan){
		$this->db->insert($this->table_name,$data_golongan);
	}

	public function update($id_golongan,$data_golongan){
		$this->db->where($this->table_pk,$id_golongan);
		$this->db->update($this->table_name,$data_golongan);
	}

	public function delete($id_golongan){
		$this->db->where($this->table_pk,$id_golongan);
		$this->db->delete($this->table_name);
	}
}